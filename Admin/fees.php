<?php
include '../config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
	header("Location: ../login.php");
	exit();
}

// Create table if not exists (best-effort)
$create_table_sql = "CREATE TABLE IF NOT EXISTS fees (
	id INT AUTO_INCREMENT PRIMARY KEY,
	student_id INT,
	amount DECIMAL(10,2),
	status ENUM('paid','unpaid') DEFAULT 'unpaid',
	due_date DATE,
	description TEXT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($create_table_sql)) {
	$err = "Failed to create fees table: " . $conn->error;
}

// Ensure created_at column exists (handles older tables)
$colCheck = $conn->query("SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME='fees' AND COLUMN_NAME='created_at'");
if ($colCheck && $colCheck->num_rows == 0) {
	$conn->query("ALTER TABLE fees ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
}

// Ensure description column exists
$descCheck = $conn->query("SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME='fees' AND COLUMN_NAME='description'");
if ($descCheck && $descCheck->num_rows == 0) {
	$conn->query("ALTER TABLE fees ADD COLUMN description TEXT NULL");
}

$err = null; $msg = null;

// Fetch students
$students = $conn->query("SELECT id, name FROM users WHERE role='student' ORDER BY name");

// Handle add/update fee
if (isset($_POST['save_fee'])) {
	$student_id = intval($_POST['student_id']);
	$amount = floatval($_POST['amount']);
	$status = $_POST['status'] === 'paid' ? 'paid' : 'unpaid';
	$due_date = $_POST['due_date'];
	$description = trim($_POST['description'] ?? '');
	if ($student_id && $amount > 0 && $due_date) {
		if (!empty($_POST['id'])) {
			$id = intval($_POST['id']);
			$stmt = $conn->prepare("UPDATE fees SET student_id=?, amount=?, status=?, due_date=?, description=? WHERE id=?");
			if ($stmt) {
				$stmt->bind_param("idsssi", $student_id, $amount, $status, $due_date, $description, $id);
				$ok = $stmt->execute();
				$msg = $ok ? 'Fee updated.' : 'Failed to update fee: ' . $conn->error;
			} else {
				$err = 'Failed to prepare update statement: ' . $conn->error;
			}
		} else {
			$stmt = $conn->prepare("INSERT INTO fees (student_id, amount, status, due_date, description) VALUES (?, ?, ?, ?, ?)");
			if ($stmt) {
				$stmt->bind_param("idsss", $student_id, $amount, $status, $due_date, $description);
				$ok = $stmt->execute();
				$msg = $ok ? 'Fee assigned.' : 'Failed to assign fee: ' . $conn->error;
			} else {
				$err = 'Failed to prepare insert statement: ' . $conn->error;
			}
		}
	} else { $err = 'Student, amount, and due date are required.'; }
}

// Handle delete fee
if (isset($_GET['delete'])) {
	$id = intval($_GET['delete']);
	$stmt = $conn->prepare("DELETE FROM fees WHERE id=?");
	if ($stmt) {
		$stmt->bind_param("i", $id);
		$msg = $stmt->execute() ? 'Fee deleted.' : 'Failed to delete fee: ' . $conn->error;
	} else {
		$err = 'Failed to prepare delete statement: ' . $conn->error;
	}
}

// Handle edit fetch
$edit = null;
if (isset($_GET['edit'])) {
	$id = intval($_GET['edit']);
	$stmt = $conn->prepare("SELECT * FROM fees WHERE id=?");
	if ($stmt) {
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result) {
			$edit = $result->fetch_assoc();
		} else {
			$err = 'Failed to fetch fee record: ' . $conn->error;
		}
	} else {
		$err = 'Failed to prepare select statement: ' . $conn->error;
	}
}

// Fees list with fallback ordering
$fees_query = "SELECT f.*, u.name FROM fees f JOIN users u ON f.student_id=u.id ORDER BY f.created_at DESC";
$fees_result = $conn->query($fees_query);
if (!$fees_result) {
	$fees_query = "SELECT f.*, u.name FROM fees f JOIN users u ON f.student_id=u.id ORDER BY f.id DESC";
	$fees_result = $conn->query($fees_query);
	if (!$fees_result) {
		$err = 'Failed to fetch fees: ' . $conn->error;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Fees Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Inter:400,600,700&display=swap" rel="stylesheet">
	<style>
	body { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #2563eb 0%, #f59e42 100%); min-height: 100vh; }
	.glass-card { background: rgba(255,255,255,0.92); border-radius: 1.5rem; box-shadow: 0 8px 32px rgba(30,41,59,0.18); backdrop-filter: blur(12px); border: 1.5px solid #e2e8f0; animation: floatIn .9s ease; }
	@keyframes floatIn { from { opacity:0; transform: translateY(24px);} to { opacity:1; transform:none; } }
	.receipt { border: 1px dashed #94a3b8; padding: 1rem; border-radius: .75rem; background: #f8fafc; }
	.navbar { background: rgba(255,255,255,0.95) !important; backdrop-filter: blur(12px); }
	.navbar-brand { color: #0d6efd !important; font-weight: 700; }
	.navbar-nav .nav-link { color: #495057 !important; }
	.navbar-nav .nav-link:hover { color: #0d6efd !important; }
	.navbar-nav .nav-link.active { color: #0d6efd !important; font-weight: 600; }
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
  <div class="container-fluid">
	<a class="navbar-brand" href="dashboard.php">Admin ERP</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
	  <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
	  <ul class="navbar-nav ms-auto">
		<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
		<li class="nav-item"><a class="nav-link" href="manage_students.php">Students</a></li>
		<li class="nav-item"><a class="nav-link" href="manage_courses.php">Courses</a></li>
		<li class="nav-item"><a class="nav-link" href="manage_faculty.php">Faculty</a></li>
		<li class="nav-item"><a class="nav-link" href="assign_courses.php">Assign</a></li>
		<li class="nav-item"><a class="nav-link" href="attendance.php">Attendance</a></li>
		<li class="nav-item"><a class="nav-link" href="results.php">Results</a></li>
		<li class="nav-item"><a class="nav-link" href="notices.php">Notices</a></li>
		<li class="nav-item"><a class="nav-link active" href="fees.php">Fees</a></li>
		<li class="nav-item"><a class="nav-link" href="reports.php">Reports</a></li>
		<li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
	  </ul>
	</div>
  </div>
</nav>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="dashboard.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    <h3 class="mb-0">Fees Management</h3>
  </div>
  <?php if($msg) echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>$msg<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>"; ?>
  <?php if($err) echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$err<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>"; ?>

  <div class="row g-4">
	<div class="col-lg-5">
	  <div class="glass-card p-4">
		<h4 class="mb-3"><?= $edit ? 'Edit Fee' : 'Assign Fee' ?></h4>
		<form method="post">
		  <?php if($edit): ?><input type="hidden" name="id" value="<?= htmlspecialchars($edit['id']) ?>"><?php endif; ?>
		  <div class="mb-3">
			<label class="form-label" for="student_id">Student</label>
			<select class="form-select" id="student_id" name="student_id" required>
			  <option value="">-- Select Student --</option>
			  <?php foreach($students as $s): ?>
				<option value="<?= $s['id'] ?>" <?= isset($edit['student_id']) && $edit['student_id']==$s['id'] ? 'selected' : '' ?>><?= htmlspecialchars($s['name']) ?></option>
			  <?php endforeach; ?>
			</select>
		  </div>
		  <div class="mb-3">
			<label class="form-label" for="amount">Amount</label>
			<input type="number" step="0.01" class="form-control" id="amount" name="amount" required value="<?= htmlspecialchars($edit['amount'] ?? '') ?>">
		  </div>
		  <div class="row g-2 mb-3">
			<div class="col-6">
			  <label class="form-label" for="due_date">Due Date</label>
			  <input type="date" class="form-control" id="due_date" name="due_date" required value="<?= htmlspecialchars($edit['due_date'] ?? '') ?>">
			</div>
			<div class="col-6">
			  <label class="form-label" for="status">Status</label>
			  <select class="form-select" id="status" name="status">
				<option value="unpaid" <?= (isset($edit['status']) && $edit['status']==='unpaid')?'selected':'' ?>>Unpaid</option>
				<option value="paid" <?= (isset($edit['status']) && $edit['status']==='paid')?'selected':'' ?>>Paid</option>
			  </select>
			</div>
		  </div>
		  <div class="mb-3">
			<label class="form-label" for="description">Description</label>
			<textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($edit['description'] ?? '') ?></textarea>
		  </div>
		  <button class="btn btn-primary" type="submit" name="save_fee"><?= $edit ? 'Update Fee' : 'Assign Fee' ?></button>
		  <?php if($edit): ?><a class="btn btn-link" href="fees.php">Cancel</a><?php endif; ?>
		</form>
	  </div>
	</div>

	<div class="col-lg-7">
	  <div class="glass-card p-4">
		<div class="d-flex justify-content-between align-items-center mb-3">
		  <h4 class="mb-0">Fees Overview</h4>
		  <span class="text-muted small">Latest assignments</span>
		</div>
		<div class="table-responsive">
		  <table class="table table-striped align-middle">
			<thead class="table-primary">
			  <tr>
				<th>Student</th>
				<th>Amount</th>
				<th>Status</th>
				<th>Due Date</th>
				<th>Receipt</th>
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
			  <?php if ($fees_result): while($f = $fees_result->fetch_assoc()): ?>
			  <tr>
				<td><?= htmlspecialchars($f['name']) ?></td>
				<td>$<?= number_format($f['amount'], 2) ?></td>
				<td>
				  <span class="badge <?= $f['status']==='paid' ? 'bg-success' : 'bg-warning text-dark' ?>"><?= strtoupper($f['status']) ?></span>
				</td>
				<td><?= htmlspecialchars($f['due_date']) ?></td>
				<td>
				  <a href="fees_receipt.php?id=<?= $f['id'] ?>" class="btn btn-sm btn-outline-secondary" target="_blank">Download</a>
				</td>
				<td>
				  <a href="?edit=<?= $f['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
				  <a href="?delete=<?= $f['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this fee record?')">Delete</a>
				</td>
			  </tr>
			  <?php endwhile; endif; ?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
