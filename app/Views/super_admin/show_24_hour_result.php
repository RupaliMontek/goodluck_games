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
   <div class="frHeadingAndButton"> <h2>24 Hour History</h2>
     <button onclick="goBack()">Back</button>
     </div>
    <div class="input-group">
        <div class="fradminhistorySearch" data-mdb-input-init>
            <!--<input id="search-focus" type="search" class="form-control" onkeyup="searchAdmin()" /> <i class="fa fa-search"></i>-->
        </div>
    </div>
    <table class="adminHistoryTablee">
    <thead>
        <tr>
            <th>SR No</th>
            <!--th>Player Name</th-->
            <th>Result</th>
            <th>Date & Time</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($result)): ?>
            <tr id="no-data-message">
                <td colspan="3" class="no-data-message">No data available</td>
            </tr>
        <?php else: ?>
            <?php $sr_no = 1; ?>
            <?php foreach ($result as $admin): ?>
                <tr>
                    <td><?= $sr_no++ ?></td>
                    <!--td><? //admin['first_name'] . ' ' . $admin['last_name']?></td-->
                    <td><?= $admin['numbers'] ?></td>
                    <td><?= $admin['created_datetime'] ?></td>
                </tr>
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
            window.location.href = '<?php echo base_url('superadmin')?>';
        }
    </script>

    </div>
    </div>