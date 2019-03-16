    
<?php
require_once "include/common.php";
?>

<html>
<body>
    <div class="w3-container" id="appplication_status" style="margin-top:40px;">
        <h1>User Registration</h1>
        <form action="signup.php" method="POST">
            <table>
                <tr>
                    <td>First Name:</td>
                    <td><input class="w3-input w3-border" type="text" name="firstName" required></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input class="w3-input w3-border" type="text" name="lastName" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input class="w3-input w3-border" type="text" name="email" required></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input class="w3-input w3-border" type="text" name="phone" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input class="w3-input w3-border" type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <select class="w3-input w3-border" name='role'>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button class="w3-button w3-black w3-section" type="submit">Submit</button>
        </form>
    </div>
    
<?php
printErrors();
?>

</body>
</html>