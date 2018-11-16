<?php

class User {

  public function get_id($uid) {

    $id = 0;

    $query = "SELECT user_id FROM user WHERE user_uid = '$uid';";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $id = $data['user_id'];

      }

    }

    return $id;

  }

  public function get_uid($id) {

    $uid = 0;

    $query = "SELECT user_uid FROM user WHERE user_id = $id;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $uid = $data['user_uid'];

      }

    }

    return $uid;

  }


  public function is_signed_in() {

    if (isset($_SESSION['id'])) return true;

  }

  public function sign_in($email, $password) {

    $query = "SELECT user_uid, email, firstname, lastname, password
      FROM user WHERE email = '$email' LIMIT 1;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        if (strlen($data['password']) >= 6) {

          if (password_verify($password, $data['password'])) {

            $_SESSION = [
              'id'             => md5(uniqid($data['user_uid'], true)),
              'user_id'        => $_SESSION['user_uid'] = $data['user_uid'],
              'user_email'     => $data['email'],
              'user_firstname' => $data['firstname'],
              'user_lastname'  => $data['lastname']
            ];

            return true;

          }

        }

      }

    }

  }

  public function sign_out() {

    session_destroy();
    session_unset();
    unset($_SESSION['id']);
    $_SESSION = [];

  }

  public function add($data) {

    $user_uid = md5(uniqid(rand(), true));
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
/*
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $role_id = $data['role_id'];
*/

    $firstname = 'John';
    $lastname = 'Doe';
    $role_id = '1';
    $created = date('Y-m-d H:i:s');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	response_json(['error' => 'E-mail address is invalid'], 400);
	throw new Exception('E-mail address is invalid');
    }
    //if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email)) throw new Exception('E-mail address is invalid');
    if ($this->user_email_exists($email)) {
	response_json(['error' => 'E-mail address is already taken'], 400);
	throw new Exception('E-mail address is already taken');

    }

    $query = "INSERT INTO user (user_uid, email, password, firstname, lastname, role_id, created)
      VALUES ('$user_uid', '$email', '$password', '$firstname', '$lastname', $role_id, '$created');
    INSERT INTO user_contact (user_id)
      VALUES (LAST_INSERT_ID());
    INSERT INTO user_info (user_id)
      VALUES (LAST_INSERT_ID());
    INSERT INTO user_clothing (user_id)
      VALUES (LAST_INSERT_ID());";

    if (sql::$con->multi_query($query) === true) return sql::$con->insert_id;

  }

  public function update($id, $data) {

    $firstname = addslashes($data['firstname']);
    $lastname = addslashes($data['lastname']);
    $birthdate = date('Y-m-d', strtotime($data['birthdate']));
    $role_id = (int)$data['role_id'];
    $drivers_license = (int)$data['drivers_license'];
    $email = $data['email'];
    $password = $data['password'];
    $phone = $data['phone'];
    $street = addslashes($data['street']);
    $street_number = $data['street_number'] ?: 0;
    $street_extra = $data['street_extra'];
    $postal = $data['postal'];
    $city = addslashes($data['city']);
    $country = addslashes($data['country']);
    $nationality = addslashes($data['nationality']);
    $birth_city = addslashes($data['birth_city']);
    $birth_country = addslashes($data['birth_country']);
    $id_id = (int)$data['id_id'] ?: 0;
    $id_exp = date('Y-m-d', strtotime($data['id_exp']));
    $csn = (int)$data['csn'] ?: 0;
    $length = $data['length'];
    $wage = $data['wage'] ?: 0.00;
    $travel_cost = $data['travel_cost'];
    $contract_start = date('Y-m-d', strtotime($data['contract_start']));
    $contract_end = date('Y-m-d', strtotime($data['contract_end']));
    $service_start = date('Y-m-d', strtotime($data['service_start']));
    $card_number = (int)$data['card_number'];
    $card_exp = date('Y-m-d', strtotime($data['card_exp']));
    $sizes_shirt = (int)$data['sizes_shirt'];
    $sizes_pants = $data['sizes_pants'];
    $sizes_costume = $data['sizes_costume'];
    $sizes_shoes = $data['sizes_shoes'];

    $query = "START TRANSACTION;
      UPDATE user SET
      email = '$email',
      firstname = '$firstname',
      lastname = '$lastname',
      role_id = $role_id
      WHERE user_id = $id;
      UPDATE user_info SET
      birthdate = '$birthdate',
      birth_city = '$birth_city',
      birth_country = '$birth_country',
      nationality = '$nationality',
      csn = $csn,
      id_id = $id_id,
      id_exp = '$id_exp',
      length = $length,
      wage = $wage,
      travel_cost = $travel_cost,
      card_number = $card_number,
      card_exp = '$card_exp',
      contract_start = '$contract_start',
      contract_end = '$contract_end',
      service_start = '$service_start'
      WHERE user_id = $id;
      UPDATE user_contact SET
      phone = '$phone',
      street = '$street',
      street_number = $street_number,
      street_extra = '$street_extra',
      postal = '$postal',
      city = '$city',
      country = '$country'
      WHERE user_id = $id;
      UPDATE user_clothing SET
      shirt = $sizes_shirt,
      pants = $sizes_pants,
      costume = $sizes_costume,
      shoes = $sizes_shoes
      WHERE user_id = $id;
      COMMIT;";

    if (sql::$con->multi_query($query) === true) return true;

  }

  public function list() {

    $employees = [];
/*
 * email
 * roles
 *
 * */
    $query = "SELECT user.user_id, user.user_uid, user.firstname, user.lastname, user.email, user.role_id,
      user_contact.phone, user_contact.country, user_contact.city,
      user_info.birthdate, user_info.contract_end, user_info.rating, user_info.specialty,
      role.name AS role_name,
      user_diploma.name AS user_diploma,
      user_skill.name AS user_skill,
      user_portfolio.image_id,
      user_image.source_uid AS user_image
      
      FROM user
      LEFT JOIN user_contact
      ON user_contact.user_id = user.user_id
      LEFT JOIN user_info
      ON user_info.user_id = user.user_id
      LEFT JOIN role
      ON role.role_id = user.role_id

      LEFT JOIN user_diploma
      ON user_diploma.user_id = user.user_id
      LEFT JOIN user_review
      ON user_review.user_id = user.user_id
      LEFT JOIN user_skill
      ON user_skill.user_id = user.user_id
      LEFT JOIN user_portfolio
      ON user_portfolio.user_id = user.user_id
      LEFT JOIN user_image
      ON user_image.image_id = user_portfolio.image_id
      
      ORDER BY user.lastname ASC";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $employees[] = [
          'id'        => (int)$data['user_id'],
          'uid'       => $data['user_uid'] ?? '',
          'firstname' => $data['firstname'] ?? '',
          'lastname'  => $data['lastname'] ?? '',
          'email'     => $data['email'] ?? '',
          'phone'     => (int)$data['phone'] ?? 0,
          'country'   => $data['country'] ?? '',
          'city'      => $data['city'] ?? '',

          'role_id'   => $data['role_id'],
          'role_name' => $data['role_name'],
          'age'       => birthdate_to_age($data['birthdate']) ?? '',
          'contract_end' => $data['contract_end'] ?? '',
          'rating'    => $data['rating'] ?? 0,
          'specialty' => $data['specialty'] ?? '',
          'user_diploma' => $data['user_diploma'] ?? '',
          'user_skill' => $data['user_skill'] ?? '',
          'user_image' => $data['user_image'] ?? ''
        ];

      }

    }

    return $employees;

  }

  public function export($user_id = 'ALL') {

    $target_user = "";
    if ($user_id != 'ALL') $target_user = "WHERE user_id = $user_id ";

    $info = [];

    $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
      role.role_id, role.name AS role_name,
      user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city,
      user_info.id_id, user_info.id_exp, user_info.length,
      user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
      user_info.drivers_license,
      user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
      user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes
      FROM user
      LEFT JOIN role
      ON role.role_id = user.role_id
      LEFT JOIN user_info
      ON user_info.user_id = user.user_id
      LEFT JOIN user_contact
      ON user_contact.user_id = user.user_id
      LEFT JOIN user_clothing
      ON user_clothing.user_id = user.user_id
      $target_user;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $contract = $this->contract($data['contract_id']);

        if (!$data['contract_end']) $contract_end = 'Vast';
        else $contract_end = date('Y-m-d', strtotime($data['contract_end']));

        $address = $data['street'] . ' ' . $data['street_number'];
        if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

        if ($data['drivers_license']) $drivers_license = 'Ja';
        else $drivers_license = 'Nee';

        $info[] = [
          'firstname'       => $data['firstname'],
          'lastname'        => $data['lastname'],
          'role'            => $data['role_title'],
          'email'           => $data['email'],
          'phone'           => $data['phone'],
          'address'         => $address,
          'postal'          => $data['postal'],
          'city'            => $data['city'],
          'country'         => $data['country'],
          'birthdate'       => date('Y-m-d', strtotime($data['birthdate'])),
          'nationality'     => $data['nationality'],
          'birth_country'   => $data['birth_country'],
          'birth_city'      => $data['birth_city'],
          'csn'             => $data['csn'],
          'id_id'           => $data['id_id'],
          'id_exp'          => $data['id_exp'],
          'length'          => $data['length'],
          'service_start'   => date('Y-m-d', strtotime($data['service_start'])),
          'wage'            => $data['wage'],
          'travel_cost'     => $data['travel_cost'],
          'contract'        => $contract,
          'contract_start'  => date('Y-m-d', strtotime($data['contract_start'])),
          'contract_end'    => $contract_end,
          'card_number'     => $data['card_number'],
          'card_exp'        => date('Y-m-d', strtotime($data['card_exp'])),
          'drivers_license' => $drivers_license,
          'shirt'           => $data['sizes_shirt'],
          'costume'         => $data['sizes_costume'],
          'pants'           => $data['sizes_pants'],
          'shoes'           => $data['sizes_shoes']
        ];

      }

    }

    return $info;

  }

  public function info($id) {

    $id = (int)$id;
    $info = [];

    $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
      role.role_id, role.name AS role_name,
      user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city,
      user_info.id_id, user_info.id_exp, user_info.length,
      user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
      user_info.drivers_license,
      user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
      user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes
      FROM user
      LEFT JOIN role
      ON role.role_id = user.role_id
      LEFT JOIN user_info
      ON user_info.user_id = user.user_id
      LEFT JOIN user_contact
      ON user_contact.user_id = user.user_id
      LEFT JOIN user_clothing
      ON user_clothing.user_id = user.user_id
      WHERE user.user_id = $id;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $contract = $this->contract($data['contract_id']);

        if (!$data['contract_end']) $contract_end = 'Vast';
        else $contract_end = date('Y-m-d', strtotime($data['contract_end']));

        $info = [
          'id'              => $data['user_id'],
          'uid'             => $data['user_uid'],
          'firstname'       => $data['firstname'],
          'lastname'        => $data['lastname'],
          'role_id'         => $data['role_id'],
          'role'            => $data['role_title'],
          'email'           => $data['email'],
          'phone'           => $data['phone'],
          'street'          => $data['street'],
          'street_number'   => $data['street_number'],
          'street_extra'    => $data['street_extra'],
          'postal'          => $data['postal'],
          'city'            => $data['city'],
          'country'         => $data['country'],
          'birthdate'       => date('Y-m-d', strtotime($data['birthdate'])),
          'nationality'     => $data['nationality'],
          'birth_country'   => $data['birth_country'],
          'birth_city'      => $data['birth_city'],
          'csn'             => $data['csn'],
          'id_id'           => $data['id_id'],
          'id_exp'          => $data['id_exp'],
          'length'          => $data['length'],
          'service_start'   => date('Y-m-d', strtotime($data['service_start'])),
          'wage'            => $data['wage'],
          'travel_cost'     => $data['travel_cost'],
          'contract'        => $contract,
          'contract_start'  => date('Y-m-d', strtotime($data['contract_start'])),
          'contract_end'    => $contract_end,
          'card_number'     => $data['card_number'],
          'card_exp'        => date('Y-m-d', strtotime($data['card_exp'])),
          'drivers_license' => $data['drivers_license'],
          'clothing'        => [
            'shirt'           => $data['sizes_shirt'],
            'costume'         => $data['sizes_costume'],
            'pants'           => $data['sizes_pants'],
            'shoes'           => $data['sizes_shoes']
          ]
        ];

      }

    }

    return $info;

  }

  public function availability($user_id) {

    $availability = [];

    $query = "SELECT user_availability.id, user_availability.user_id, user_availability.comment,
      user_availability.time_start, user_availability.time_end, user_availability.type_id,
      availability_type.description
      FROM user_availability
      LEFT JOIN availability_type
      ON availability_type.type_id = user_availability.type_id
      WHERE user_availability.user_id = $user_id
      AND user_availability.time_start >= CURDATE();";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $availability[] = [
          'id'          => $data['id'],
          'user_id'     => $data['user_id'],
          'comment'     => $data['comment'],
          'time_start'  => $data['time_start'],
          'time_end'    => $data['time_end'],
          'type_id'     => $data['type_id'],
          'type'        => $data['description']
        ];

      }

    }

    return $availability;

  }

  public function files($user_id) {

    $user_uid = $this->get_uid($user_id);

    $files = [];

    $path = APP . 'file/' . $user_uid . '/';
    $raw_files = scandir($path);

    foreach ($raw_files as $raw_file) {

      if ($raw_file != '.' && $raw_file != '..') {

        $filectime = filectime($path . $raw_file);
        $filesize = filesize($path . $raw_file);

        $files[] = [
          'name'    => $raw_file,
          'created' => date('Y-m-d', $filectime),
          'size'    => $filesize
        ];

      }

    }

    return $files;

  }

  public function contract($id) {

    $id = (int)$id;
    $contract = 'Unknown';

    $query = "SELECT name FROM contract WHERE contract_id = $id";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $contract = $data['name'];

      }

    }

    return $contract;

  }

  public function user_email_exists($email) {

    $query = "SELECT user_uid FROM user WHERE email = '$email';";

    if ($res = sql::$con->query($query)) {

      if ($res->num_rows) return true;
      else return false;

    } else {

      return false;

    }

  }

  public function shifts($user_id, $period = 'ALL') {

    if (strcasecmp($period, 'UPCOMING')) $where_date = "shift.time_start < CURDATE() ";
    else if (strcasecmp($period, 'COMPLETE')) $where_date = "shift.time_start >= CURDATE() ";
    else $where_date = "shift.time_start IS NOT NULL ";

    $shifts = [];

    $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
      shift.location_id, shift.confirmed, shift.break,
      location.name AS location_name, location.street, location.street_number,
      location.street_extra, location.postal, location.city, location.country,
      employer.employer_id, employer.name AS employer_name, employer.phone, employer.email
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      WHERE user_id = $user_id
      AND $where_date
      ORDER BY shift.time_start DESC
      LIMIT 30;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $address = $data['street'] . ' ' . $data['street_number'];
        if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

        $hours = time_difference($data['time_start'], $data['time_end']);

        $shifts[] = [
          'id'            => $data['shift_id'],
          'uid'           => $data['shift_uid'],
          'time_start'    => date('Y-m-d H:i', strtotime($data['time_start'])),
          'time_end'      => date('Y-m-d H:i', strtotime($data['time_end'])),
          'hours'         => $hours,
          'employer_id'   => $data['employer_id'],
          'employer_name' => $data['employer_name'],
          'location_id'   => $data['location_id'],
          'location'      => $data['location_name'],
          'address'       => $address,
          'street'        => $data['street'],
          'street_number' => $data['street_number'],
          'street_extra'  => $data['street_extra'],
          'postal'        => $data['postal'],
          'city'          => $data['city'],
          'country'       => $data['country'],
          'phone'         => $data['phone'],
          'email'         => $data['email'],
          'confirmed'     => $data['confirmed'],
          'break'         => $data['break']
        ];

      }

    }

    return $shifts;

  }

  public function shifts_late($user_id) {

    $shifts = [];

    $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
      shift.location_id, shift.confirmed, shift.break, shift.late,
      location.name AS location_name, location.street, location.street_number,
      location.street_extra, location.postal, location.city, location.country,
      employer.employer_id, employer.name AS employer_name, employer.phone, employer.email
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      WHERE shift.user_id = $user_id
      AND shift.late > 0
      ORDER BY shift.time_start DESC
      LIMIT 30;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $address = $data['street'] . ' ' . $data['street_number'];
        if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

        $hours = time_difference($data['time_start'], $data['time_end']);

        $shifts[] = [
          'id'            => $data['shift_id'],
          'uid'           => $data['shift_uid'],
          'time_start'    => date('Y-m-d H:i', strtotime($data['time_start'])),
          'time_end'      => date('Y-m-d H:i', strtotime($data['time_end'])),
          'hours'         => $hours,
          'employer_id'   => $data['employer_id'],
          'employer_name' => $data['employer_name'],
          'location_id'   => $data['location_id'],
          'location'      => $data['location_name'],
          'address'       => $address,
          'street'        => $data['street'],
          'street_number' => $data['street_number'],
          'street_extra'  => $data['street_extra'],
          'postal'        => $data['postal'],
          'city'          => $data['city'],
          'country'       => $data['country'],
          'phone'         => $data['phone'],
          'email'         => $data['email'],
          'confirmed'     => $data['confirmed'],
          'break'         => $data['break'],
          'late'          => $data['late']
        ];

      }

    }

    return $shifts;

  }

  public function shifts_export($user_id = 'ALL', $period = 'ALL') {

    $target_user = "";
    if ($user_id != 'ALL') $target_user = "AND shift.user_id = $user_id ";

    if (strcasecmp($period, 'UPCOMING')) $target_period = "WHERE shift.time_start < CURDATE() ";
    else if (strcasecmp($period, 'COMPLETE')) $target_period = "WHERE shift.time_start >= CURDATE() ";
    else $target_period = "WHERE shift.time_start IS NOT NULL ";

    $shifts = [];

    $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
      shift.location_id, shift.confirmed, shift.break,
      location.name AS location_name, location.street, location.street_number,
      location.street_extra, location.postal, location.city, location.country,
      employer.employer_id, employer.name AS employer_name, employer.phone AS employer_phone, employer.email,
      user.firstname AS user_firstname, user.lastname AS user_lastname,
      user_contact.phone AS user_phone
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      LEFT JOIN user
      ON user.user_id = shift.user_id
      LEFT JOIN user_contact
      ON user_contact.user_id = shift.user_id
      $target_period
      $target_user
      ORDER BY shift.time_start DESC
      LIMIT 30;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $address = $data['street'] . ' ' . $data['street_number'];
        if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

        $shifts[] = [
          'date_start'      => date('m-d-Y', strtotime($data['time_start'])),
          'time_start'      => date('H:i', strtotime($data['time_start'])),
          'time_end'        => date('H:i', strtotime($data['time_end'])),
          'user_name'       => $data['user_firstname'] . ' ' . $data['user_lastname'],
          'user_phone'      => $data['user_phone'],
          'employer_name'   => $data['employer_name'],
          'employer_phone'  => $data['employer_phone'],
          'location_name'   => $data['location_name'],
          'address'         => $address,
          'postal'          => $data['postal'],
          'city'            => $data['city'],
          'country'         => $data['country']
        ];

      }

    }

    return $shifts;

  }

  public function roles() {

    $roles = [];

    $query = "SELECT role_id, name
      FROM role
      ORDER BY role_id DESC;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $roles[] = [
          'id'      => $data['role_id'],
          'name'    => $data['name']
        ];

      }

    }

    return $roles;

  }

  public function tasks($user_id) {

    $tasks = [];

    $query = "SELECT task_id, user_id, description, time_start, time_end, complete
      FROM user_task
      WHERE user_id = $user_id
      ORDER BY complete ASC, task_id DESC;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $tasks[] = [
          'id'          => $data['task_id'],
          'user_id'     => $data['user_id'],
          'description' => $data['description'],
          'time_start'  => $data['time_start'],
          'time_end'    => $data['time_end'],
          'complete'    => $data['complete']
        ];

      }

    }

    return $tasks;

  }

  public function paychecks($user_id, $year = 'current') {

    if ($year == 'current') $year = date('Y');

    $paychecks = [];

    for ($i = 12; $i >= 1; $i--) {

      $month = sprintf('%02d', $i);
      $date = $year . '-' . $month . '-01';

      if ($month <= date('m')) $paychecks[$date] = $this->paycheck($user_id, $date);

    }

    return $paychecks;

  }

  public function paycheck($user_id, $month) {

    $paycheck = 0;
    $wage = 0;
    $hours = 0;

    $query = "SELECT user.user_id,
      shift.time_start, shift.time_end,
      user_info.wage
      FROM shift
      LEFT JOIN user
      ON user.user_id = shift.user_id
      LEFT JOIN user_info
      ON user_info.user_id = shift.user_id
      WHERE shift.user_id = $user_id
      AND MONTH(shift.time_start) = MONTH('$month')
      AND YEAR(shift.time_start) = YEAR('$month');";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $wage = $data['wage'];
        $hours += time_difference($data['time_start'], $data['time_end']);

      }

    }

    $paycheck = $hours * $wage;

    return $paycheck;

  }

  public function search($string) {

    $users = [];

    $string = str_replace(' ', '+', $string);
    $needles = explode('+', $string);

    $query = "SELECT user_id, user_uid, firstname, lastname
      FROM user
      WHERE firstname != 0 ";

    foreach ($needles as $needle) {

      $query .= "OR firstname LIKE '%$needle%' OR lastname LIKE '%$needle%' OR email LIKE '%$needle%' ";

    }

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $users[] = [
          'uid'        => $data['user_uid'],
          'name'       => $data['firstname'] . ' ' . $data['lastname'],
          'url'        => '/users/' . $data['user_id']
        ];

      }

    }

    return $users;

  }

}

$user = new User;

?>
