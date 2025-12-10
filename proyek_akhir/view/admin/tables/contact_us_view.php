<?php
$data = get_all_data('contact_us');
$columns = get_columns('contact_us');
?>

<style>
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: -30px;
    margin-top: -15px;
    font-size: 15px;
}

/* TOMBOL TAMBAH */
.btn-tambah {
    background: #0d6efd;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    display: inline-block;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-tambah:hover {
    background: #0b5ed7;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    color: white;
}

/* CONTAINER TOMBOL AKSI */
.btn-action-container {
    display: flex;
    gap: 8px;
}

/* STYLING TOMBOL EDIT */
.btn-edit {
    background: #ffc107;
    color: #212529;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-edit:hover {
    background: #e0a800;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(255, 193, 7, 0.3);
    text-decoration: none;
    color: #212529;
}

/* STYLING TOMBOL DELETE */
.btn-delete {
    background: #dc3545;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-delete:hover {
    background: #c82333;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
    text-decoration: none;
    color: white;
}

/* STYLING BADGE UNTUK MESSAGE TYPE */
.badge-message-type {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.badge-feedback {
    background: #28a745;
    color: white;
}

.badge-movie-request {
    background: #007bff;
    color: white;
}

.badge-bug-report {
    background: #dc3545;
    color: white;
}

.badge-partnership {
    background: #6f42c1;
    color: white;
}


</style>

<div>
    <div class="topbar">
        <h3>Data Contact Us</h3>
        <a href="admin_controller.php?action=tambah&table=contact_us" class="btn-tambah">Tambah Contact</a>
    </div>
   
    <br><br>
    
    <?php if (empty($data)): ?>
        <div class="no-data">
            <i class="bi bi-inbox" style="font-size: 48px; margin-bottom: 10px;"></i>
            <h3>Tidak ada data ditemukan</h3>
            <p>Klik "Tambah Contact" untuk menambahkan data baru</p>
        </div>
    <?php else: ?>
        <table>
            <thead> 
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message Type</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): 
                    // Tentukan badge class berdasarkan message_type
                    $badge_class = '';
                    switch($row['message_type']) {
                        case 'Feedback': $badge_class = 'badge-feedback'; break;
                        case 'Movie Request': $badge_class = 'badge-movie-request'; break;
                        case 'Bug Report': $badge_class = 'badge-bug-report'; break;
                        case 'Partnership': $badge_class = 'badge-partnership'; break;
                        default: $badge_class = 'badge-feedback'; break;
                    }
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($row['phone'] ?? '-'); ?></td>
                        <td>
                            <span class="badge-message-type <?php echo $badge_class; ?>">
                                <?php echo htmlspecialchars($row['message_type']); ?>
                            </span>
                        </td>
                        <td class="message-preview" title="<?php echo htmlspecialchars($row['message']); ?>">
                            <?php 
                            if (strlen($row['message']) > 50) {
                                echo substr($row['message'], 0, 50) . '...';
                            } else {
                                echo htmlspecialchars($row['message']);
                            }
                            ?>
                        </td>
                        <td><?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></td>
                        <td>
                            <div class="btn-action-container">
                                <!-- UBAH TOMBOL EDIT SEPERTI USERWATCHLIST -->
                                <a href="admin_controller.php?action=edit&table=contact_us&id=<?php echo $row['id']; ?>" class="btn-edit">✏️ Edit</a>
                                <a href="admin_controller.php?action=hapus&table=contact_us&id=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn-delete">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>