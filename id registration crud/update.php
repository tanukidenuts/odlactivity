<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_no'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id_no = isset($_POST['id_no']) ? $_POST['id_no'] : NULL;
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
        $course = isset($_POST['course']) ? $_POST['course'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare('UPDATE student_info SET id_no = ?, first_name = ?, middle_name = ?, last_name = ?, email = ?, phone = ?, address = ?, sex = ?, course = ?, password = ?, created = ? WHERE id_no = ?');
        $stmt->execute([$id_no, $first_name, $middle_name, $last_name, $email, $phone, $address, $sex, $course, $password, $created, $_GET['id_no']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the student_info table
    $stmt = $pdo->prepare('SELECT * FROM student_info WHERE id_no = ?');
    $stmt->execute([$_GET['id_no']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$student) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Read')?>

<div class="content update">
	<h2>Update student #<?=$student['id_no']?></h2>
    <form action="update.php?id_no=<?=$student['id_no']?>" method="post">
        <label for="id">ID</label>
		<label for="first_name">First Name</label>
		<input type="text" name="id_no"  placeholder="1" value="<?=$student['id_no']?>" id="id_no">
        <input type="text" name="first_name"  value="<?=$student['first_name']?>" id="first_name">
		
		<label for="middle_name">Middle Name</label>
		<label for="last_name">Last Name</label>
		<input type="text" name="middle_name" value="<?=$student['middle_name']?>" id="middle_name">
		<input type="text" name="last_name" value="<?=$student['last_name']?>" id="last_name">
		
		<label for="email">Email</label>
		<label for="phone">Phone</label>	
		<input type="text" name="email" value="<?=$student['email']?>" id="email">
        <input type="text" name="phone" value="<?=$student['phone']?>" id="phone">
		
        <label for="course">Address</label>
        <label for="course">Sex</label>
		<br><input type="text" name="address" value="<?=$student['address']?>" id="address">
		<br><input type="text" name="sex" value="<?=$student['sex']?>" id="sex">
        
		
		<label for="course">Courses</label>
		<br><input type="text" name="course" value="<?=$student['course']?>" id="course">
		<label for="password">Password</label>
		<label for="repassword">Re-enter Password</label>
				
		<input type="text" name="password" value="<?=$student['password']?>" id="password">
       
		
		<label for="created">Date Registered</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Update">
		
		<!--
		<label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$student['id']?>" id="id">
        <input type="text" name="name" placeholder="John Doe" value="<?=$student['name']?>" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$student['email']?>" id="email">
        <input type="text" name="phone" placeholder="2025550143" value="<?=$student['phone']?>" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" value="<?=$student['title']?>" id="title">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($student['created']))?>" id="created">
        <input type="submit" value="Update"> -->
		
    </form>
	
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>