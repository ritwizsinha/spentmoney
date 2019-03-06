<!DOCTYPE html>
<html lang="en">
<?php 
include('header.php');
include('config/open_db.php');
if (isset($_POST['submit'])) {


    $activity = mysqli_real_escape_string($conn, $_POST['activity']);
    $price  = mysqli_real_escape_string($conn, $_POST['amount']);
    $sql =  "INSERT INTO Prices(NAME,PRICE) VALUES(' $activity ', '$price')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $result = mysqli_fetch_all($query);
    } else {
        echo "Connection Error:  " . mysqli_error($conn);;
    }
    header('Location: index.php');
    mysli_free_result($result);
    mysqli_close($conn);
}

?>

<body>
    <h1>budget Calculator</h1>
    <form action="index.php" method="POST">
        <label>Money Spent on </label>
        <input type="text" name="activity" placeholder="where did you spend" value="<?php echo $activity ?>" required> <br>
        <label>Amount Spend</label>
        <input type="number" name="amount" placeholder="amount in ruppes" value="<?php echo $amount ?>" required><br>
        <input type="submit" value="submit" name="submit">
    </form>
    <table>
        <thead>
            <tr>
                <td>MONEY SPENT ON</td>
                <td>Amount</td>
            </tr>
        </thead>

        <?php
        $sql = 'SELECT ID,NAME,PRICE,TIME_ADDED FROM Prices ORDER BY TIME_ADDED';
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            echo "connection error : " . mysqli_error($conn);
        } else {
            $result  = $query;
            $sum = 0;
            $prices = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($prices as $price) {
                $sum = $sum + $price['PRICE'];

                ?>
        <tr>
            <td><?php echo htmlspecialchars($price['NAME']); ?></td>
            <td><?php echo htmlspecialchars($price['PRICE']); ?></td>
        </tr>
        <?php 
    }
}

?>
    </table>
    <h1 class="total"><?php echo $sum; ?></h1>
    <script src="main.js"></script>
</body>

</ html> 