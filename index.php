<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library | Dashboard</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📘</text></svg>">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <h1>LIBRARY MANAGEMENT</h1>
    </header>

    <div class="container">
        <div class="top-bar">
            <div>
                <h2 style="margin:0; color: #2b4ca1;">Inventory Overview</h2>
                <p style="margin: 5px 0 0; color: #666; font-size: 0.9rem;">Standard XII Science Project Portfolio</p>
            </div>
            
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <form action="" method="GET" style="display: flex; gap: 8px;">
                    <div class="search-container">
                        <input type="text" name="search" id="searchInput" placeholder="Search title or author..." 
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
                        
                        <?php if(!empty($_GET['search'])): ?>
                            <a href="index.php" class="btn-clear" title="Clear Search">✕</a>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn-search">Search</button>
                </form>
                <button onclick="openModal('addModal')" class="btn-add">+ Register Book</button>
            </div>
        </div>
        
        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>ISBN</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'libary_management');
                    if ($conn->connect_error) die("Database connection failed");

                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $sql = "SELECT * FROM books " . ($search ? "WHERE title LIKE '%$search%' OR author LIKE '%$search%' " : "") . "ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Prepare data for JS
                            $rowData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                            ?>
                            <tr>
                                <td class='id-text'><?php echo $row["id"]; ?></td>
                                <td><strong><?php echo htmlspecialchars($row["title"]); ?></strong></td>
                                <td><?php echo htmlspecialchars($row["author"]); ?></td>
                                <td><small style="color: #666;"><?php echo htmlspecialchars($row["email"]); ?></small></td>
                                <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                                <td><?php echo htmlspecialchars($row["address"]); ?></td>
                                <td><span class='badge-isbn'><?php echo htmlspecialchars($row["isbn"]); ?></span></td>
                                <td class='action-group'>
                                    <button onclick='handleEdit(<?php echo $rowData; ?>)' class='btn-icon btn-edit-icon' title='Edit'>
                                        <svg viewBox='0 0 24 24'><path d='M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z'/></svg>
                                    </button>
                                    <a href='delete.php?id=<?php echo $row["id"]; ?>' class='btn-icon btn-delete-icon' title='Delete' onclick='return confirm("Delete this book permanently?")'>
                                        <svg viewBox='0 0 24 24'><path d='M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z'/></svg>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { 
                        echo "<tr><td colspan='8' style='text-align:center; padding:60px; color: #999;'>
                                <div style='font-size: 3rem;'>📂</div>
                                <p>No books found.</p>
                              </td></tr>"; 
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addModal')">&times;</span>
                <h2 style="color:#2b4ca1;">Register New Book</h2>
                <form action="process.php?action=add" method="POST">
                    <div class="form-group"><label>Title</label><input type="text" name="title" required></div>
                    <div class="form-group"><label>Author</label><input type="text" name="author" required></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
                    <div class="form-group"><label>Phone</label><input type="text" name="phone"></div>
                    <div class="form-group"><label>Location</label><input type="text" name="address"></div>
                    <div class="form-group"><label>ISBN</label><input type="text" name="isbn" required></div>
                    <button type="submit" class="btn-search" style="width:100%;">Save Book</button>
                </form>
            </div>
        </div>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('editModal')">&times;</span>
                <h2 style="color:#e53e27;">Update Details</h2>
                <form action="process.php?action=edit" method="POST">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group"><label>Title</label><input type="text" name="title" id="edit_title" required></div>
                    <div class="form-group"><label>Author</label><input type="text" name="author" id="edit_author" required></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" id="edit_email" required></div>
                    <div class="form-group"><label>Phone</label><input type="text" name="phone" id="edit_phone"></div>
                    <div class="form-group"><label>Location</label><input type="text" name="address" id="edit_address"></div>
                    <div class="form-group"><label>ISBN</label><input type="text" name="isbn" id="edit_isbn" required></div>
                    <button type="submit" class="btn-search" style="width:100%; background:#2b4ca1;">Update Changes</button>
                </form>
            </div>
        </div>

<footer>
    <div style="margin-bottom: 20px;">
        <img src="assets/venus logo.png" alt="Venus Logo" class="footer-logo">
        <p style="font-weight: 600; color: #2b4ca1; letter-spacing: 1px;">VENUS NATIONAL COLLEGE</p>
    </div>
    
    <a href="https://github.com/Jangbu001/Libary-management-CURD-" target="_blank" class="github-link" style="display: inline-flex; align-items: center; gap: 10px; background: #333; color: white; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-size: 0.9rem; transition: 0.3s;">
        <svg height="20" width="20" fill="white" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg>
        View Source on GitHub
    </a>
    
    <p style="font-size: 0.8rem; color: #999; margin-top: 25px; border-top: 1px solid #eee; padding-top: 15px;">
        © 2025 • Designed by <strong>Jangbu Sherpa</strong> • XII (Science)
    </p>
</footer>
    </div>

    <script src="script.js"></script>
</body>

</html>
