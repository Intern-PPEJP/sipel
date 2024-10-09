<?php
// Include the database connection file
include_once "../connect.php";

// CRUD Operations
class ECPCrud {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Create
    public function create($data) {
        $sql = "INSERT INTO t_ecp (Daerah, Produk, Tgl_Bln_Ekspor, Tahun_Ekspor, Negara_Tujuan, Nilai_Ekspor_USD, Nilai_Ekspor_Rupiah, Keterangan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssiidds", $data['Daerah'], $data['Produk'], $data['Tgl_Bln_Ekspor'], $data['Tahun_Ekspor'], 
                          $data['Negara_Tujuan'], $data['Nilai_Ekspor_USD'], $data['Nilai_Ekspor_Rupiah'], $data['Keterangan']);
        return $stmt->execute();
    }

    // Read
    public function read($filters = [], $limit = 50, $search = '') {
        $sql = "SELECT * FROM t_ecp WHERE 1=1";
        $params = [];
        $types = "";

        if (!empty($search)) {
            $sql .= " AND (Daerah LIKE ? OR Produk LIKE ? OR Negara_Tujuan LIKE ?)";
            $searchParam = "%$search%";
            $params = array_merge($params, [$searchParam, $searchParam, $searchParam]);
            $types .= "sss";
        }

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $sql .= " AND $key = ?";
                $params[] = $value;
                $types .= "s";
            }
        }

        $sql .= " LIMIT ?";
        $params[] = $limit;
        $types .= "i";

        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update
    public function update($id, $data) {
        $sql = "UPDATE t_ecp SET Daerah=?, Produk=?, Tgl_Bln_Ekspor=?, Tahun_Ekspor=?, Negara_Tujuan=?, 
                Nilai_Ekspor_USD=?, Nilai_Ekspor_Rupiah=?, Keterangan=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssiiddsi", $data['Daerah'], $data['Produk'], $data['Tgl_Bln_Ekspor'], $data['Tahun_Ekspor'], 
                          $data['Negara_Tujuan'], $data['Nilai_Ekspor_USD'], $data['Nilai_Ekspor_Rupiah'], $data['Keterangan'], $id);
        return $stmt->execute();
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM t_ecp WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get unique values for filters
    public function getUniqueValues($column) {
        $result = $this->conn->query("SELECT DISTINCT $column FROM t_ecp ORDER BY $column");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$crud = new ECPCrud($conn);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $crud->create($_POST);
    } elseif (isset($_POST['update'])) {
        $crud->update($_POST['id'], $_POST);
    } elseif (isset($_POST['delete'])) {
        $crud->delete($_POST['id']);
    }
}

// Get filter values
$filters = [
    'Daerah' => $_GET['filter_daerah'] ?? '',
    'Produk' => $_GET['filter_produk'] ?? '',
    'Tahun_Ekspor' => $_GET['filter_tahun'] ?? '',
    'Negara_Tujuan' => $_GET['filter_negara'] ?? ''
];

$limit = isset($_GET['limit']) ? min(50, max(1, intval($_GET['limit']))) : 50;
$search = $_GET['search'] ?? '';

// Fetch filtered records
$records = $crud->read($filters, $limit, $search);

// Get unique values for filters
$daerahs = $crud->getUniqueValues('Daerah');
$produks = $crud->getUniqueValues('Produk');
$tahuns = $crud->getUniqueValues('Tahun_Ekspor');
$negaras = $crud->getUniqueValues('Negara_Tujuan');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECP CRUD System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 95%;
            margin: auto;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        form {
            background: #f4f4f4;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"], button {
            display: inline-block;
            background: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover, button:hover {
            background: #555;
        }
        .actions {
            white-space: nowrap;
        }
        .actions button {
            padding: 5px 10px;
            margin-right: 5px;
        }
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .filters > * {
            flex: 1;
            min-width: 150px;
        }
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }
            table {
                font-size: 14px;
            }
            th, td {
                padding: 5px;
            }
            .actions button {
                padding: 3px 6px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ECP CRUD System</h1>
        
        <!-- Search and Filters -->
        <form method="get" action="">
            <div class="filters">
                <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                <select name="filter_daerah">
                    <option value="">All Daerah</option>
                    <?php foreach ($daerahs as $daerah): ?>
                        <option value="<?php echo htmlspecialchars($daerah['Daerah']); ?>" <?php if ($filters['Daerah'] == $daerah['Daerah']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($daerah['Daerah']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="filter_produk">
                    <option value="">All Produk</option>
                    <?php foreach ($produks as $produk): ?>
                        <option value="<?php echo htmlspecialchars($produk['Produk']); ?>" <?php if ($filters['Produk'] == $produk['Produk']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($produk['Produk']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="filter_tahun">
                    <option value="">All Tahun</option>
                    <?php foreach ($tahuns as $tahun): ?>
                        <option value="<?php echo htmlspecialchars($tahun['Tahun_Ekspor']); ?>" <?php if ($filters['Tahun_Ekspor'] == $tahun['Tahun_Ekspor']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($tahun['Tahun_Ekspor']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="filter_negara">
                    <option value="">All Negara</option>
                    <?php foreach ($negaras as $negara): ?>
                        <option value="<?php echo htmlspecialchars($negara['Negara_Tujuan']); ?>" <?php if ($filters['Negara_Tujuan'] == $negara['Negara_Tujuan']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($negara['Negara_Tujuan']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="limit">
                    <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                    <option value="25" <?php if ($limit == 25) echo 'selected'; ?>>25</option>
                    <option value="50" <?php if ($limit == 50) echo 'selected'; ?>>50</option>
                </select>
                <button type="submit">Apply Filters</button>
            </div>
        </form>

        <!-- Display Records -->
        <h2>Records</h2>
        <table>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>Daerah</th>
                <th>Produk</th>
                <th>Tgl_Bln_Ekspor</th>
                <th>Tahun_Ekspor</th>
                <th>Negara_Tujuan</th>
                <th>Nilai_Ekspor_USD</th>
                <th>Nilai_Ekspor_Rupiah</th>
                <th>Keterangan</th>
            </tr>
            <?php foreach ($records as $record): ?>
            <tr>
                <td class="actions">
                    <button onclick="editRecord(<?php echo $record['id']; ?>)"><i class="fas fa-edit"></i></button>
                    <button onclick="deleteRecord(<?php echo $record['id']; ?>)"><i class="fas fa-trash"></i></button>
                </td>
                <td><?php echo htmlspecialchars($record['id']); ?></td>
                <td><?php echo htmlspecialchars($record['Daerah']); ?></td>
                <td><?php echo htmlspecialchars($record['Produk']); ?></td>
                <td><?php echo htmlspecialchars($record['Tgl_Bln_Ekspor']); ?></td>
                <td><?php echo htmlspecialchars($record['Tahun_Ekspor']); ?></td>
                <td><?php echo htmlspecialchars($record['Negara_Tujuan']); ?></td>
                <td><?php echo htmlspecialchars($record['Nilai_Ekspor_USD']); ?></td>
                <td><?php echo htmlspecialchars($record['Nilai_Ekspor_Rupiah']); ?></td>
                <td><?php echo htmlspecialchars($record['Keterangan']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Create Form -->
        <h2>Add New Record</h2>
        <form method="post">
            <input type="text" name="Daerah" placeholder="Daerah" required>
            <input type="text" name="Produk" placeholder="Produk" required>
            <input type="text" name="Tgl_Bln_Ekspor" placeholder="Tgl_Bln_Ekspor" required>
            <input type="number" name="Tahun_Ekspor" placeholder="Tahun_Ekspor" required>
            <input type="text" name="Negara_Tujuan" placeholder="Negara_Tujuan" required>
            <input type="number" name="Nilai_Ekspor_USD" placeholder="Nilai_Ekspor_USD" step="0.01" required>
            <input type="number" name="Nilai_Ekspor_Rupiah" placeholder="Nilai_Ekspor_Rupiah" step="0.01" required>
            <input type="text" name="Keterangan" placeholder="Keterangan">
            <input type="submit" name="create" value="Add Record">
        </form>

        <!-- Update Form (hidden by default) -->
        <div id="updateForm" style="display:none;">
            <h2>Update Record</h2>
            <form method="post">
                <input type="hidden" id="updateId" name="id">
                <input type="text" id="updateDaerah" name="Daerah" placeholder="Daerah" required>
                <input type="text" id="updateProduk" name="Produk" placeholder="Produk" required>
                <input type="text" id="updateTglBlnEkspor" name="Tgl_Bln_Ekspor" placeholder="Tgl_Bln_Ekspor" required>
            <input type="number" name="Tahun_Ekspor" placeholder="Tahun_Ekspor" required>
            <input type="text" name="Negara_Tujuan" placeholder="Negara_Tujuan" required>
            <input type="number" name="Nilai_Ekspor_USD" placeholder="Nilai_Ekspor_USD" step="0.01" required>
            <input type="number" name="Nilai_Ekspor_Rupiah" placeholder="Nilai_Ekspor_Rupiah" step="0.01" required>
            <input type="text" name="Keterangan" placeholder="Keterangan">
            <input type="submit" name="update" value="Update Record">
        </form>
    </div>
</body>
</html>