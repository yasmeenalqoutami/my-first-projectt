<div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            Welcome
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            <?php echo $_SESSION['user']; ?>
            <br/>
            <?php 
            include "../config.php";

            // افتراض أن المستخدم مسجل في $_SESSION['user']
            $uId = intval($_SESSION['user']);

            // استرجاع بيانات المستخدم الأساسية
            $userQuery = mysqli_query($conn, "SELECT * FROM `info` WHERE uId = '$_SESSION[user]'");
            if (mysqli_num_rows($userQuery) > 0) {
                $user = mysqli_fetch_assoc($userQuery);

            $sPrice = floatval($user['sPrice']);
            $nCigarettesInPack = intval($user['nCigarettes']); // عدد السجائر في العلبة
            $nDailyOriginal = intval($user['nDaily']); // معدل اليومي الأصلي

            // سعر السيجارة الواحدة
            $pricePerCig = $sPrice / $nCigarettesInPack;

            // استرجاع جميع تسجيلات اليومية للمستخدم
            $logQuery = mysqli_query($conn, "SELECT * FROM `tracking` WHERE `uId` = '$_SESSION[user]' ORDER BY `log_date` ASC");

            $cumulativeSavings = 0;

            if ($logQuery && mysqli_num_rows($logQuery) > 0):
                while ($log = mysqli_fetch_assoc($logQuery)):
                    $cigsSmoked = intval($log['nCigarettes']);
                    $savedCigs = $nDailyOriginal - $cigsSmoked;
                    $dailySaving = round($savedCigs * $pricePerCig, 2);
                    $cumulativeSavings += $dailySaving;
                endwhile;
            endif;

            // الآن نبدأ بتحديد المستوى بناءً على $cumulativeSavings
            if ($cumulativeSavings <= 50) {
                echo "Level <span class='badge badge-danger'>1</span>";
            } elseif ($cumulativeSavings >= 51 && $cumulativeSavings <= 100) {
                echo "Level <span class='badge badge-primary'>2</span>";
            } elseif ($cumulativeSavings >= 101 && $cumulativeSavings <= 150) {
                echo "Level <span class='badge badge-warning'>3</span>";
            } elseif ($cumulativeSavings >= 151 && $cumulativeSavings <= 200) {
                echo "Level <span class='badge badge-info'>4</span>";
            } else {
                echo "Level <span class='badge badge-success'>5</span>";
            }
            }
            
            ?>
          </a>
        </div>
        <ul class="nav">

          <li>
            <a href="nStatus.php">
              <i class="tim-icons icon-bell-55"></i>
              <p>Add New Status</p>
            </a>
          </li>
          <li>
            <a href="./tracking.php">
              <i class="tim-icons icon-bell-55"></i>
              <p>Daily tracking</p>
            </a>
          </li>
          <li>
            <a href="./user.php">
              <i class="tim-icons icon-align-center"></i>
              <p>Chat <?php 
              
              include("../config.php"); // تأكد أنك عامل الاتصال بقاعدة البيانات هنا

              // استعلام لجلب عدد الرسائل الغير مقروءة
              $query = "SELECT COUNT(*) as `unread_count` FROM `chatting` WHERE `status` = 0 AND sId = '$_SESSION[user]'";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $unreadCount = $row['unread_count'];

              if($unreadCount > 0): ?>
                <span class="badge badge-danger"><?php echo $unreadCount; ?></span>
              <?php endif; ?></p>
            </a>
          </li>
          <li>
            <a href="./cConsultant.php">
              <i class="tim-icons icon-align-center"></i>
              <p>Chat Doctor</p>
            </a>
          </li>
          <li>
            <a href="./vProducts.php">
              <i class="tim-icons icon-align-center"></i>
              <p>Products</p>
            </a>
          </li>
          <li>
            <a href="./wallet.php">
              <i class="tim-icons icon-align-center"></i>
              <p>My wallet</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="Logout.php" class="nav-item dropdown-item">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>