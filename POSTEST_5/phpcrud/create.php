<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO sigup VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $email, $nomor, $password]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
    <h2>Buat Akun</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="auto" id="id" >
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" placeholder="Name">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="exemple@gmail.com">

        <label for="nomor">No. Telpon</label>
        <input type="text" name="nomor" id="nomor" placeholder="081234567890">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>