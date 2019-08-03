<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<form method="post">
    <strong>From:</strong> <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd"/>
    <strong>To:</strong> <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"/>
    <input type="submit" id="submit" value="Search"/>
    <?php
    $customer_list = array(
        "0" => array("name" => "Mai Văn Hoàn", "day_of_birth" => "1983/08/20", "address" => "Hà Nội", "image" => "images/img1.jpg"),
        "1" => array("name" => "Nguyễn Văn Nam", "day_of_birth" => "1983/08/21", "address" => "Bắc Giang", "image" => "images/img2.jpg"),
        "2" => array("name" => "Nguyễn Thái Hòa", "day_of_birth" => "1983/08/22", "address" => "Nam Định", "image" => "images/img3.jpg"),
        "3" => array("name" => "Trần Đăng Khoa", "day_of_birth" => "1983/08/17", "address" => "Hà Tây", "image" => "images/img4.jpg"),
        "4" => array("name" => "Nguyễn Đình Thi", "day_of_birth" => "1983/08/19", "address" => "Hà Nội", "image" => "images/img5.jpg")
    );
    ?>
    <?php
    function searchByDate($customers_List, $from_date, $to_date)
    {
        if (empty($from_date) && empty($to_date)) {
            return $customers_List;
        }
        $filtered_customers = [];
        foreach ($customers_List as $customer) {
            if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
                continue;
            if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
                continue;
            $filtered_customers[] = $customer;
        }
        return $filtered_customers;
    }
    $from_date = NULL;
    $to_date = NULL;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $from_date = $_POST["from"];
        $to_date = $_POST["to"];
    }
    $filtered_customers = searchByDate($customer_list, $from_date, $to_date);
   ?>

    <table border="0">
        <caption><h2>Danh sách khách hàng</h2></caption>
        <tr>
            <th><strong>STT</strong></th>
            <th><strong>Tên</strong></th>
            <th><strong>Ngày sinh</strong></th>
            <th><strong>Địa chỉ</strong></th>
            <th><strong>Ảnh</strong></th>
        </tr>

        <?php if (count($filtered_customers) === 0): ?>
        <tr>
            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
        <?php endif;?>

        <?php foreach ($filtered_customers as $index => $customer) { ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['day_of_birth']; ?></td>
                <td><?php echo $customer['address']; ?></td>
                <td>
                    <div class="profile"><img src="<?php echo $customer['profile']; ?>"/></div>
                </td>
            </tr>
        <?php
        }; ?>
    </table>
</form>
</body>
</html>
