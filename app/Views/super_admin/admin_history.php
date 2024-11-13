<script>
        function searchAdmin() {
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
   <div class="frHeadingAndButton"> <h1>Admin History</h1>
     <button onclick="goBack()">Back</button>
     </div>
    <div class="input-group">
        <div class="fradminhistorySearch" data-mdb-input-init>
            <input id="search-focus" type="search" class="form-control" onkeyup="searchAdmin()" /> <i class="fa fa-search"></i>
        </div>
    </div>
    <table class="adminHistoryTablee">
        <thead>
            <tr>
                <th>Admin Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>amount given</th>    
                <th>current wallet</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($history)): ?>
                <tr id="no-data-message" style="display: none;">
                    <td colspan="2" class="no-data-message">No data available</td>
                </tr>
                <?php else: ?>
                <?php foreach ($history as $admin): ?>
                    <?php if ($admin['role'] === 'admin'): ?>
            
                    <tr>
                        <td><?= $admin['first_name'] . ' ' . $admin['last_name']; ?></td>
                        <td><?= $admin['username']; ?></td>
                        <td><?= $admin['role']; ?></td>
                        <td><?= $admin['amout_given']; ?></td>
                        <td><?= $admin['current_wallet']; ?></td>   
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
   
<div class="pagination">
            <?= $pager->links() ?>
</div>
    <div class="input-group">

<script>
    function goBack() {
            window.history.back();
        }
    </script>

    </div>
    </div>