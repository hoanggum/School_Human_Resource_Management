<?php
include_once '../Controller/LeaveApplicationSheetController.php';
$controller = new LeaveApplicationSheetController();

// Get filter parameters from URL
$status = isset($_GET['status']) ? $_GET['status'] : 'All';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['pagez']) ? $_GET['pagez'] : 1;
$items_per_page = 10; // Change this value as per your requirement

// Fetch filtered data with pagination
$leaveSheetsData = $controller->getFilteredLeaveApplicationSheets($status, $sort, $search, $page, $items_per_page);

// Get total number of leave application sheets for pagination
$total_leave_sheets = $controller->getTotalLeaveApplicationSheets($status, $search);
$total_pages = ceil($total_leave_sheets / $items_per_page);

?>

<nav class="navbar navbar-expand-md box d-flex flex-column">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="add-new-btn" aria-current="page" href="#">Add new</button>
                </li>
            </ul>
            <form class="d-flex search-box justify-content-end" method="get" action="?page=managerLeaveApplicationSheet">
                <input type="hidden" name="status" value="<?php echo $status; ?>">
                <input type="hidden" name="sort" value="<?php echo $sort; ?>">
                <input class="form-control" type="search" placeholder="Search" name="search" aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
                <button class="search-btn" type="submit">Search</button>
            </form>
        </div>
    </div>
    <di class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#orderListSelectBox" aria-controls="orderListSelectBox"
                aria-expanded="false" aria-label="Toggle navigation">
            All
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="orderListSelectBox">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="classify-btn" href="?page=managerLeaveApplicationSheet&status=Wait for confirmation&sort=<?php echo $sort; ?>&search=<?php echo htmlspecialchars($search); ?>">Wait for confirmation</a>
                </li>
                <li class="nav-item">
                    <a class="classify-btn" href="?page=managerLeaveApplicationSheet&status=All&sort=<?php echo $sort; ?>&search=<?php echo htmlspecialchars($search); ?>">All</a>
                </li>
                <li class="nav-item">
                    <a class="classify-btn" href="?page=managerLeaveApplicationSheet&status=Confirmed&sort=<?php echo $sort; ?>&search=<?php echo htmlspecialchars($search); ?>">Confirmed</a>
                </li>
                <li class="nav-item">
                    <a class="classify-btn" href="?page=managerLeaveApplicationSheet&status=Cancelled&sort=<?php echo $sort; ?>&search=<?php echo htmlspecialchars($search); ?>">Cancelled</a>
                </li>
                <li class="nav-item">
                    <a class="classify-btn" href="?page=managerLeaveApplicationSheet&status=Done&sort=<?php echo $sort; ?>&search=<?php echo htmlspecialchars($search); ?>">Done</a>
                </li>
            </ul>
        </div>
    </di v>
</nav>
<div class="box list-box d-flex flex-column">
    <div class="header-list-box d-flex flex-column">
        <div class="list-box-title d-flex">
            <h3 class="list-box-title-text list-box-total">Total: <?php echo count($leaveSheetsData); ?></h3>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSort" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort
                    <i class="fa-solid fa-arrow-down-1-9"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSort">
                    <li><a class="dropdown-item" href="?page=managerLeaveApplicationSheet&status=<?php echo $status; ?>&sort=ASC&search=<?php echo htmlspecialchars($search); ?>">Sort <i class="fa-solid fa-arrow-down-1-9"></i></a></li>
                    <li><a class="dropdown-item" href="?page=managerLeaveApplicationSheet&status=<?php echo $status; ?>&sort=DESC&search=<?php echo htmlspecialchars($search); ?>">Sort <i class="fa-solid fa-arrow-down-9-1"></i></a></li>
                </ul>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="pagination-nav d-flex justify-content-center">
            
            <ul class="pagination">
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=managerLeaveApplicationSheet&pagez=<?php echo ($page <= 1) ? 1 : ($page - 1); ?>&status=<?php echo htmlspecialchars($status); ?>&sort=<?php echo htmlspecialchars($sort); ?>&search=<?php echo htmlspecialchars($search); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=managerLeaveApplicationSheet&pagez=<?php echo $i; ?>&status=<?php echo htmlspecialchars($status); ?>&sort=<?php echo htmlspecialchars($sort); ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=managerLeaveApplicationSheet&pagez=<?php echo ($page >= $total_pages) ? $total_pages : ($page + 1); ?>&status=<?php echo htmlspecialchars($status); ?>&sort=<?php echo htmlspecialchars($sort); ?>&search=<?php echo htmlspecialchars($search); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="content-list-box order-list">
        <div class="row">
            <div class="col-md">
                <?php foreach ($leaveSheetsData as $leaveSheet): ?>
                <div class="row order-item">
                    <div class="card">
                        <div class="card-serial">
                            <h2 class="serial"><?php echo $leaveSheet['LSheetID']; ?></h2>
                        </div>
                        <div class="card-body col-md d-flex flex-row">
                            <div class="flex-child">
                                <a href="#" class="order-id"><?php echo $leaveSheet['LSheetID']; ?></a>
                            </div>
                            <div class="flex-child">
                                <span class="card-text">Đơn xin <?php echo $leaveSheet['Type']; ?></span>
                            </div>
                            <div class="flex-child">
                                <span class="card-text"><?php echo $leaveSheet['FullName']; ?></span>
                            </div>
                            <div class="flex-child">
                                <span class="card-text"><?php echo $leaveSheet['StartDate']; ?></span>
                            </div>
                            <div class="flex-child">
                                <span class="card-text"> --></span>
                            </div>
                            <div class="flex-child">
                                <span class="card-text"><?php echo $leaveSheet['EndDate']; ?></span>
                            </div>
                        </div>
                        <div class="col-md action-btn d-flex">
                            <div class="wait-for-confirm-box col">
                                <span class="card-text"><?php echo $leaveSheet['LStatus']; ?></span>
                            </div>
                            <button class="detail-btn col" data-bs-toggle="collapse" href="#<?php echo $leaveSheet['LSheetID']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $leaveSheet['LSheetID']; ?>">
                                Detail
                            </button>
                        </div>
                    </div>
                    <div class="collapse" id="<?php echo $leaveSheet['LSheetID']; ?>">
                        <div class="detail-order">
                            <div class="infor-customer row">
                                <div class="col-md-2">
                                    <span class="card-text"><?php echo $leaveSheet['FullName']; ?></span>
                                </div>
                                <div class="col-md-2">
                                    <span class="card-text"><?php echo $leaveSheet['Phone']; ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text"><?php echo $leaveSheet['Email']; ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="card-text"><?php echo $leaveSheet['Address']; ?></span>
                                </div>
                            </div>
                            <div class="order-product-list">
                                <div class="product-item row">
                                    <a href="#" class="col-md-2 product-img">
                                        <img style="width: 100px;" class="img-fluid" alt="Product-Img" src="../img/<?php echo $leaveSheet['Url']; ?>">
                                    </a>
                                    <div class="card-body col-md-5">
                                        <a href="#">
                                            <h2 class="card-title">Tôi tên <?php echo $leaveSheet['FullName']; ?></h2>
                                        </a>
                                        <hr>
                                        <p class="card-text type-shoes">Ngày nghỉ phép: <?php echo $leaveSheet['StartDate']; ?></p>
                                        <p class="card-text type-shoes">Lý do xin nghỉ phép: <?php echo $leaveSheet['Reason']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-detail-order">
                                <!-- Trang giao diện người dùng -->
                                <?php if ($leaveSheet['LStatus'] === 'Wait for confirmation'): ?>
                                    <!-- Hiển thị nút Confirm và Cancel khi trạng thái là Wait for confirmation -->
                                    <a class="edit-btn col" href="?page=processLeaveSheet&action=confirm&LSheetID=<?php echo $leaveSheet['LSheetID']; ?>">Confirm</a>
                                    <a class="delete-btn col" href="?page=processLeaveSheet&action=cancel&LSheetID=<?php echo $leaveSheet['LSheetID']; ?>">Cancel</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="footer-list-box d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <p class="quantity">
                <?php echo htmlspecialchars($page); ?>/<?php echo htmlspecialchars($total_pages); ?> Total
            </p>
            <ul class="pagination">
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=managerLeaveApplicationSheet&pagez=<?php echo ($page <= 1) ? 1 : ($page - 1); ?>&status=<?php echo htmlspecialchars($status); ?>&sort=<?php echo htmlspecialchars($sort); ?>&search=<?php echo htmlspecialchars($search); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=managerLeaveApplicationSheet&pagez=<?php echo $i; ?>&status=<?php echo htmlspecialchars($status); ?>&sort=<?php echo htmlspecialchars($sort); ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=managerLeaveApplicationSheet&pagez=<?php echo ($page >= $total_pages) ? $total_pages : ($page + 1); ?>&status=<?php echo htmlspecialchars($status); ?>&sort=<?php echo htmlspecialchars($sort); ?>&search=<?php echo htmlspecialchars($search); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script>
var statusValue = "<?php echo $status; ?>";

var classifyBtns = document.querySelectorAll('.classify-btn');
classifyBtns.forEach(function (btn) {
    if (btn.textContent.trim() === statusValue) {
        btn.classList.add('classify-btn-selected');
    }
});
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
