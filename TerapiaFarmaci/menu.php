<div class="wrapper">
 
        <nav id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <h3>Terapia farmaci</h3>
			</div>
           
 
            <!-- Sidebar Links -->
            <ul class="list-unstyled components">
                <li class="active"><a href="index.php">Home</a></li>
                <!-- <li><a href="#">About</a></li>
                <li><!-- Link with dropdown items 
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                    </ul> -->
                <li><a href="confronto.php">Confronto</a></li>
                <li><a href="contatti.php">Contatti</a></li>
            </ul>
        </nav>

        <div id="content">
            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
			
       </div>
	   
	   <script>$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});
   </script> 
