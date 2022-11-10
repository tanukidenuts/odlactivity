<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_no= isset($_POST['id_no']) && !empty($_POST['id_no']) && $_POST['id_no'] != 'auto' ? $_POST['id_no'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
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
    // Insert new record into the student_info table
    $stmt = $pdo->prepare('INSERT INTO student_info VALUES (?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?)');
    $stmt->execute([$id_no, $first_name, $middle_name, $last_name, $email, $phone, $address, $sex, $course,$password, $created]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Register New Student</h2>
    <form action="create.php" method="post">
	<table>
	
		<label for="id_no">ID</label>
		<label for="first_name">First Name</label>
		<input type="text" name="id_no" placeholder="1245" value="auto" id="id_no">
        <input type="text" name="first_name" placeholder="Joshua" id="first_name">
		
		<label for="middle_name">Middle Name</label>
		<label for="last_name">Last Name</label>
		<input type="text" name="middle_name" placeholder="d great" id="middle_name">
		<input type="text" name="last_name" placeholder="garcia" id="last_name">
		
		<label for="email">Email</label>
		<label for="phone">Phone</label>	
		<input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
		
        <label for="course">Address</label>
        <label for="course">Sex</label>
		<br><input type="text" name="address" placeholder="Address" id="address">
		<br><input type="text" name="sex" placeholder="sex" id="sex">
        
		
		<label for="course">Courses</label>
		<br><input type="text" name="course" placeholder="course" id="course">
		<label for="password">Password</label>
		<label for="repassword">Re-enter Password</label>
				
		<input type="text" name="password" placeholder="*******" id="password">
        <input type="text" name="repassword" placeholder="re enter" id="repassword">
		
		<label for="created">Date Registered</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Register">
	<table>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>