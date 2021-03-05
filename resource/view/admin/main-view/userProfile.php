<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user'])) {
    header('Location:../authentication/login.php');
}

include '../../../../database/database.php';
include '../../../../function/function.php';
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Thông tin tài khoản - Web Admin</title>
    <link href="../../../../public/core/assets/css/core.css" rel="stylesheet"/>
    <link href="../../../../public/admin/assets/css/styles.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="sb-nav-fixed">
<?php
include '../partials/header.php';
?>
<div id="layoutSidenav">
    <?php
    include '../partials/layoutSideNav.php';
    ?>
    <div id="layoutSidenav_content" style="background: #f2f3f8">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Thông tin người dùng</h1>
                <ol class="breadcrumb mb-4" style="background: white">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Thông tin người dùng</li>
                </ol>
                <div class="profile__content row">
                    <div class="col-md-4">
                        <div class="profile__left">
                            <div class="profile-name">
                                <img src="<?php
                                if($user['images']){
                                    echo $user['images'];
                                }else{
                                    echo '../../../../public/admin/assets/images/userImages/defaultImage.png';
                                }
                                ?>" alt="" width="150" height="150">
                                <h5>
                                    <?php
                                    echo $user['lastname'] . " " . $user['firstname'];
                                    ?>
                                </h5>
                            </div>
                            <div class="email">
                                <p>Email:</p>
                                <p>
                                    <?php
                                    echo $user["email"];
                                    ?>
                                </p>
                            </div>
                            <a id="infoBtn" class="btn btn-light active" style="width: 100%;display: flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                              fill="#000000" fill-rule="nonzero"></path>
                                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                              fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                                Thông tin chính
                            </a>
                            <a id="resetBtn" class="btn btn-light" style="width: 100%;display: flex">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                              fill="#000000" opacity="0.3"></path>
                                        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                                              fill="#000000" opacity="0.3"></path>
                                        <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                              fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                                Đổi mật khẩu
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="profile__right">
                            <div class="profile__info active">
                                <h6>Thông tin cơ bản</h6>
                                <form action="../user/editProfile.php" method="POST" enctype="multipart/form-data">
                                    <div class="avatar form-group">
                                        <p>Avatar</p>
                                        <div class="avatar_img" style="width: 60%">
                                            <img id="profileInfo_avatar" src="<?php
                                                if($user['images']){
                                                    echo $user['images'];
                                                }else{
                                                    echo '../../../../public/admin/assets/images/userImages/defaultImage.png';
                                                }
                                            ?>" alt="" width="120" height="120">
                                            <label class="avatarLabel" for="avatar"><i class="fas fa-pen"></i><input
                                                        style="display: none" type="file" id="avatar"
                                                        name="fileToUpload"></label>
                                            <a href="../user/deleteAvatar.php?id= <?php echo $id ?>" style="border: none; background: transparent" name="avatarDelete" class="avatarDelete"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="name form-group">
                                        <p>Tên:</p>
                                        <div class="nameInput" style="display: flex;width: 60%">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fal fa-user"></i></div>
                                            </div>
                                            <input style="width: 100%" class="form-control" type="text"
                                                   name="profileFirstName" id="profileFirstName"
                                                   value="<?php echo $user['firstname']; ?>">
                                        </div>
                                    </div>
                                    <div class="name form-group">
                                        <p>Họ:</p>
                                        <div class="nameInput" style="display: flex;width: 60%">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fal fa-user"></i></div>
                                            </div>
                                            <input style="width: 100%" class="form-control" type="text"
                                                   name="profileLastName" id="profileLastName"
                                                   value="<?php echo $user['lastname']; ?>">
                                        </div>
                                    </div>
                                    <div class="email form-group">
                                        <p>Email:</p>
                                        <div class="emailInput" style="display: flex;width: 60%">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input style="width: 100%" class="form-control" type="text"
                                                   name="profileEmail"
                                                   id="profileEmail" value="<?php echo $user['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group" style="text-align: center; width: 60%; margin: 0 auto">
                                        <button name="editUserProfile" style="width: 100%" type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                            <div class="profile__pass">
                                <h6 style="padding-top: 30px">Đổi mật khẩu</h6>
                                <form action="../user/changePassword.php" method="POST">
                                    <div class="confirm form-group">
                                        <p>Mật khẩu hiện tại:</p>
                                        <input class="form-control" type="password" name="profileConfirmPass"
                                               id="profileConfirmPass">
                                        <span style="font-size: 14px; color: cornflowerblue"><a href="../authentication/forgotPassword.php">Quên mật khẩu?</a></span>
                                    </div>
                                    <div class="newPassword form-group">
                                        <p>Mật khẩu mới:</p>
                                        <input class="form-control" type="password" name="newPassword" id="newPassword">
                                    </div>
                                    <div class="repeatNewPassword form-group">
                                        <p>Nhập lại mật khẩu:</p>
                                        <input class="form-control" type="password" name="repeatNewPassword"
                                               id="repeatNewPassword">
                                    </div>
                                    <div class="form-group" style="text-align: center; width: 60%; margin: 0 auto">
                                        <button style="width: 100%" type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include '../partials/footer.php';
        ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="../../../../public/admin/assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../../../../public/core/assets/js/datatables-demo.js"></script>
</body>
</html>

