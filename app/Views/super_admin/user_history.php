<script>
        function searchUser() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search-focus");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Assuming the username is in the first column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            
            // Show "No data available" message if no matching rows found
            var noDataMessage = document.getElementById("no-data-message");
            var displayStyle = (table.querySelectorAll("tbody tr[style='display: none;']").length === tr.length) ? "block" : "none";
            noDataMessage.style.display = displayStyle;
        }
    </script>
    <style>
        .no-data-message {
            color: red;
        }
    </style>

 
 <div class="col-9 col-md-10 col-lg-10">
        <div class="container mt-3 frminheightttt frmobpaddingzeroo">
   <div class="frHeadingAndButton">
        <h1>User History</h1>
         <button class="back-button" onclick="goBack()">Back</button>
        </div>
    <div class="input-group">
        <div class="fradminhistorySearch" data-mdb-input-init>
            <input id="search-focus" type="search" class="form-control" onkeyup="searchUser()" />
            <i class="fa fa-search"></i>
        </div>
    </div>
    <table class="adminHistoryTablee">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>amount given</th>    
                <th>current wallet</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($history)): ?>
                <tr id="no-data-message" style="display: none;">
                    <td colspan="2" class="no-data-message">No data available</td>
                </tr>
                <?php else: ?>
                <?php foreach ($history as $user): ?>
                    <?php if ($user['role'] === 'user'): ?>
            
                    <tr>
                        <td><?= $user['first_name'] . ' ' . $user['last_name']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td><?= $user['amout_given']; ?></td>
                        <td><?= $user['current_wallet']; ?></td> 
                        <td>
                                <a href="https://api.whatsapp.com/send/?phone=919975048884&text&type=phone_number&app_absent=0" class="whatsapp-button">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i> Share Details via WhatsApp
                                    </a>
                            </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
   
    <div class="input-group">

<script>
    function goBack() {
            window.history.back();
        }
    </script>

    </div>
    </div>
    <div class="pagination">
    <?= $pager->links() ?>
</div>