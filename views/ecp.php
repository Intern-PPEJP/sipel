<?php
// Include the database connection file
include_once "../connect.php";

// We'll remove the Session start as it's causing issues and might not be necessary for this basic CRUD system
// If you need session functionality, you'll need to install the Delight\Cookie\Session package or use PHP's built-in session functions

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
    public function read() {
        $result = $this->conn->query("SELECT * FROM t_ecp");
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

// Fetch all records
$records = $crud->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECP CRUD System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
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
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            display: inline-block;
            background: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ECP CRUD System</h1>
        
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
        

        <!-- Display Records -->
        <h2>Records</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Daerah</th>
                <th>Produk</th>
                <th>Tgl_Bln_Ekspor</th>
                <th>Tahun_Ekspor</th>
                <th>Negara_Tujuan</th>
                <th>Nilai_Ekspor_USD</th>
                <th>Nilai_Ekspor_Rupiah</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($records as $record): ?>
            <tr>
                <td><?php echo $record['id']; ?></td>
                <td><?php echo $record['Daerah']; ?></td>
                <td><?php echo $record['Produk']; ?></td>
                <td><?php echo $record['Tgl_Bln_Ekspor']; ?></td>
                <td><?php echo $record['Tahun_Ekspor']; ?></td>
                <td><?php echo $record['Negara_Tujuan']; ?></td>
                <td><?php echo $record['Nilai_Ekspor_USD']; ?></td>
                <td><?php echo $record['Nilai_Ekspor_Rupiah']; ?></td>
                <td><?php echo $record['Keterangan']; ?></td>
                <td>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure?');">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Update Form -->
        <h2>Update Record</h2>
        <form method="post">
            <input type="number" name="id" placeholder="ID" required>
            <input type="text" name="Daerah" placeholder="Daerah" required>
            <input type="text" name="Produk" placeholder="Produk" required>
            <input type="text" name="Tgl_Bln_Ekspor" placeholder="Tgl_Bln_Ekspor" required>
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