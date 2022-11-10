<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_no'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM student_info WHERE id_no = ?');
    $stmt->execute([$_GET['id_no']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$student) {
        exit('Student doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM student_info WHERE id_no = ?');
            $stmt->execute([$_GET['id_no']]);
            $msg = 'You have deleted the student!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Contact #<?=$student['id_no']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$student['id_no']?>?</p>
    <div class="yesno">
        <a href="delete.php?id_no=<?=$student['id_no']?>&confirm=yes">Yes</a>
        <a href="delete.php?id_no=<?=$students['id_no']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>