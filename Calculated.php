<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Control Panel
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
<?php 
if (!isset($_SESSION["user"])) {
    echo "<script>location.href='../login.php';</script>";
    exit;
}

include "../config.php"; // تأكد أن هذا الملف يحتوي على اتصال قاعدة بيانات صحيح ($conn)

$uId = isset($_GET['uId']) ? intval($_GET['uId']) : 0;

// جلب معلومات المستخدم الأساسية
$query_user = mysqli_query($conn, "SELECT * FROM `info` WHERE uId = '$_SESSION[user]'");
if (!$query_user || mysqli_num_rows($query_user) == 0) {
    die("User not found.");
}
$user = mysqli_fetch_assoc($query_user);

$sPrice = floatval($user['sPrice']);
$nCigarettesInPack = intval($user['nCigarettes']); // عدد السجائر في العلبة
$nDailyOriginal = intval($user['nDaily']); // معدل السجائر اليومية الأصلي

$pricePerCig = $sPrice / $nCigarettesInPack; // سعر السيجارة الواحدة

// جلب آخر سجل يومي لعدد السجائر التي تم تدخينها
$today = date('Y-m-d');
$query_log = mysqli_query($conn, "SELECT nCigarettes FROM `tracking` WHERE uId = '$_SESSION[user]' ORDER BY log_date DESC LIMIT 1");
if ($query_log && mysqli_num_rows($query_log) > 0) {
    $log = mysqli_fetch_assoc($query_log);
    $nCigarettesToday = intval($log['nCigarettes']);
} else {
    $nCigarettesToday = $nDailyOriginal; // إذا لم يكن هناك تسجيل، نستخدم الرقم الأصلي
}

// حساب عدد السجائر المدخرة
$cigsSaved = $nDailyOriginal - $nCigarettesToday;

// حساب المدخرات المالية
$dailySavings = round($cigsSaved * $pricePerCig, 2);
$weeklySavings = round($dailySavings * 7, 2);
$monthlySavings = round($dailySavings * 30, 2);
$annualSavings = round($dailySavings * 365, 2);
?>
  <div class="wrapper">
    <div class="sidebar">

      <?php Include "header.php"; ?>

      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Basic Information</h5>
              </div>
              <div class="card-body">
                <form method="Post">
                  <table class="table table-bordered">
                    <thead>
                        <th>Date</th>
                        <th>Cigarettes Smoked</th>
                        <th>Original Daily Rate</th>
                        <th>Saved Cigs</th>
                        <th>Daily Saving (Dinars)</th>
                        <th>Cumulative Saving (Dinars)</th>
                    </thead>
                    <tbody>
                    <?php
                        // استرجاع جميع السجلات اليومية للمستخدم
                        $logQuery = mysqli_query($conn, "SELECT * FROM `tracking` WHERE `uId` = '$_SESSION[user]' ORDER BY `log_date` ASC");

                        $cumulativeSavings = 0;
                        if ($logQuery && mysqli_num_rows($logQuery) > 0):
                            while ($log = mysqli_fetch_assoc($logQuery)):
                                $date = $log['log_date'];
                                $cigsSmoked = intval($log['nCigarettes']);
                                
                                // حساب السجائر المدخرة لهذا اليوم
                                $savedCigs = $nDailyOriginal - $cigsSmoked;

                                // حساب التوفير لهذا اليوم
                                $dailySaving = round($savedCigs * $pricePerCig, 2);
                                $cumulativeSavings += $dailySaving;

                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($date); ?></td>
                                    <td><?= htmlspecialchars($cigsSmoked); ?></td>
                                    <td><?= htmlspecialchars($nDailyOriginal); ?></td>
                                    <td><?= htmlspecialchars($savedCigs); ?></td>
                                    <td><?= number_format($dailySaving, 2); ?> Dinars</td>
                                    <td><?= number_format($cumulativeSavings, 2); ?> Dinars</td>
                                </tr>
                                <?php
                            endwhile;
                        else:
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>
                            <?php
                        endif;
                        ?>
                    </tbody>
                  </table>
                </form>
              </div>
             
            </div>
          </div>
          
    </div>
  </div>
  <div class="fixed-plugin">
  <div class="dropdown show-dropdown">
    <a href="#" data-toggle="dropdown">
      <i class="fa fa-cog fa-2x"></i>
    </a>
    <ul class="dropdown-menu">
      <li class="header-title">Sidebar Background</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors text-center">
            <span class="badge filter badge-primary" data-color="primary"></span>
            <span class="badge filter badge-info active" data-color="blue"></span>
            <span class="badge filter badge-success" data-color="green"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="adjustments-line text-center color-change">
        <span class="color-label">LIGHT MODE</span>
        <span class="badge light-badge mr-2"></span>
        <span class="badge dark-badge ml-2"></span>
        <span class="color-label">DARK MODE</span>
      </li>
    </ul>
  </div>
</div>

<!-- Core JS Files -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<!-- Google Maps Plugin -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>

<!-- Notifications Plugin -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>

<!-- Control Center for Black Dashboard -->
<script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>

<!-- Demo JS -->
<script src="../assets/demo/demo.js"></script>

<script>
$(document).ready(function() {
  $().ready(function() {
    $sidebar = $('.sidebar');
    $navbar = $('.navbar');
    $main_panel = $('.main-panel');
    $full_page = $('.full-page');
    $sidebar_responsive = $('body > .navbar-collapse');
    sidebar_mini_active = true;
    white_color = false;
    window_width = $(window).width();

    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

    // Prevent event bubbling for dropdown
    $('.fixed-plugin a').click(function(event) {
      if ($(this).hasClass('switch-trigger')) {
        if (event.stopPropagation) {
          event.stopPropagation();
        } else if (window.event) {
          window.event.cancelBubble = true;
        }
      }
    });

    // Handle sidebar and main background colors
    $('.fixed-plugin .background-color span').click(function() {
      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data', new_color);
      }

      if ($main_panel.length != 0) {
        $main_panel.attr('data', new_color);
      }

      if ($full_page.length != 0) {
        $full_page.attr('filter-color', new_color);
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.attr('data', new_color);
      }
    });

    // Sidebar mini switch
    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
      if (sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        sidebar_mini_active = false;
        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
      } else {
        $('body').addClass('sidebar-mini');
        sidebar_mini_active = true;
        blackDashboard.showSidebarMessage('Sidebar mini activated...');
      }

      // Simulate resize to update charts
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });

    // Color change switch (Dark/Light)
    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
      if (white_color == true) {
        $('body').addClass('change-background');
        setTimeout(function() {
          $('body').removeClass('change-background');
          $('body').removeClass('white-content');
        }, 900);
        white_color = false;
      } else {
        $('body').addClass('change-background');
        setTimeout(function() {
          $('body').removeClass('change-background');
          $('body').addClass('white-content');
        }, 900);
        white_color = true;
      }
    });

    // Light mode button
    $('.light-badge').click(function() {
      $('body').addClass('white-content');
    });

    // Dark mode button
    $('.dark-badge').click(function() {
      $('body').removeClass('white-content');
    });

    // ✅ FINAL CHANGES HERE ✅

    // Set LIGHT MODE as default
    $('body').addClass('white-content');

    // Set Sidebar and Main Panel background to blue (badge-info)
    $('.sidebar').attr('data', 'blue');
    $('.main-panel').attr('data', 'blue');
  });
});
</script>

<!-- TrackJS -->
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script>
window.TrackJS && TrackJS.install({
  token: "ee6fab19c5a04ac1a32a645abde4613a",
  application: "black-dashboard-free"
});
</script>
</body>

</html>