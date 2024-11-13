<div class="col-9 col-md-10 col-lg-10">

<div class="container mt-3"> 
<div class="row">
      <div class="col frminheightttt">
        <div class="frHeadingAndButton">
        <h2>Change Background Theme</h2>
        </div>
<!--<div class="d-flex justify-content-between align-items-center mt-3"> 
</div> -->
<div class="table-responsive mt-3"> 
  <form id="themeForm">
        <label>
            <input type="radio" name="theme" id="light_theme" value="light_theme">
            Light Theme
        </label>
        <br>
        <label>
            <input type="radio" name="theme" id="dark_theme" value="dark_theme" checked>
            Dark Theme
        </label>
        <br>
        <button type="button" onclick="saveTheme()">Save Theme</button>
    </form>

    <div id="response"></div>
</div>
</div>
</div>
    <script>
        function saveTheme() {
            // Get the selected theme value
            var selectedTheme = $('input[name="theme"]:checked').val();

            // AJAX request
            $.ajax({
                url: '/superadmin/save_theme', // Update with your controller method
                type: 'post',
                data: {theme: selectedTheme},
                success: function(response) {
                    // Display response
                    $('#response').html(response);
                }
            });
        }
    </script>