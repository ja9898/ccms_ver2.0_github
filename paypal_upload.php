<? 
include('config.php');
include('include/header.php'); 
?>

<form action="paypal_import.php" method="post"
        enctype="multipart/form-data">
<table>
    <tr>
        <td>
            Filename:
        </td>
        <td>
            <input type="file" name="file" id="file">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input type="submit" name="submit" value="Submit">
        </td>
    </tr>
</table>
</form>
<?
include('include/footer.php');
?>