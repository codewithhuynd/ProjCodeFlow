<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản Phẩm - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* =========================================
           1. CSS CƠ BẢN VÀ LAYOUT
           ========================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* =========================================
           2. HEADER
           ========================================= */
        header {
            background-color: #1e3a8a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 40px;
        }

        .logo-nav {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .logo {
            font-weight: bold;
            font-size: 20px;
            background: #fff;
            color: #1e3a8a;
            padding: 5px 10px;
            border-radius: 4px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #93c5fd;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 15px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            padding-left: 15px;
        }

        .btn-logout {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            padding: 6px 15px;
            border-radius: 4px;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #fff;
            background: transparent;
        }

        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* =========================================
           3. KHU VỰC QUẢN LÝ (ADMIN SECTION)
           ========================================= */
        .admin-section {
            padding: 40px 80px;
            flex: 1; /* Đẩy footer xuống dưới cùng */
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .admin-title {
            color: #1e3a8a;
            font-size: 28px;
            font-weight: 800;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-success:hover {
            background-color: #059669;
        }
        
        /* Bảng hiển thị */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .admin-table th, 
        .admin-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-table th {
            background-color: #1e3a8a;
            color: white;
            font-weight: bold;
        }

        .admin-table tr:hover {
            background-color: #f1f5f9;
        }

        .product-img-small {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        /* Các nút hành động */
        .btn-edit {
            background-color: #3b82f6;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-edit:hover {
            background-color: #2563eb;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 5px;
        }

        .btn-delete:hover {
            background-color: #dc2626;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* =========================================
           4. POP-UP (MODAL) SỬA SẢN PHẨM 
           ========================================= */
        .modal-overlay {
            display: none; /* Ẩn đi theo mặc định */
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            align-items: center; 
            justify-content: center;
        }

        .modal-overlay.active { 
            display: flex; 
        } 
        
        .modal-content {
            background-color: #fff;
            width: 500px; 
            max-width: 90%;
            border-radius: 10px;
            padding: 25px;
            position: relative;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-close {
            position: absolute; 
            top: 15px; 
            right: 20px;
            font-size: 24px; 
            color: #94a3b8; 
            cursor: pointer;
            transition: 0.2s;
        }

        .modal-close:hover { 
            color: #ef4444; 
        }

        /* Style cho Form trong Modal */
        .form-group { 
            margin-bottom: 15px; 
        }

        .form-group label { 
            display: block; 
            font-weight: bold; 
            color: #334155; 
            margin-bottom: 5px; 
            font-size: 14px;
        }

        .form-control { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #cbd5e1; 
            border-radius: 5px; 
            outline: none; 
        }

        .form-control:focus { 
            border-color: #3b82f6; 
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2); 
        }

        .form-row { 
            display: flex; 
            gap: 15px; 
        }

        .form-row .form-group { 
            flex: 1; 
        }

        /* =========================================
           5. FOOTER
           ========================================= */
        footer {
            background-color: #0f172a;
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 80px;
            align-items: center;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            gap: 30px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-socials i {
            font-size: 20px;
            margin-left: 15px;
            cursor: pointer;
            color: #94a3b8;
            transition: 0.3s;
        }

        .footer-socials i:hover {
            color: #60a5fa;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo-nav">
            <img src="/images/logo.png" height="40" alt="Logo">
            <nav>
                <ul>
                    <li><a href="/admin/dashboard">Về Dashboard</a></li>
                    <li><a href="{{ route('admin.products') }}" style="color: #93c5fd; font-weight: bold;">Quản Lý Sản Phẩm</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-actions">
            <div class="auth-buttons">
                @auth
                <span style="font-size: 14px; color: #93c5fd;">Chào, <strong>{{ Auth::user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Đăng xuất</button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <section class="admin-section">
        
        @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="admin-header">
            <h2 class="admin-title">Danh sách sản phẩm</h2>
            <button onclick="openAddModal()" class="btn-success">
                <i class="fas fa-plus"></i> Thêm sản phẩm mới
            </button>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">STT</th>
                    <th style="width: 100px; text-align: center;">Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Tồn kho</th>
                    <th style="text-align: center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: center;">
                            <img src="{{ $product->image }}" alt="anh" class="product-img-small">
                        </td>
                        <td style="font-weight: bold; color: #1e3a8a;">{{ $product->name }}</td>
                        <td style="color: #ef4444; font-weight: bold;">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                        <td>{{ $product->stock }}</td>
                        <td style="text-align: center;">
                            
                            <button class="btn-edit" 
                                onclick="openEditModal(this)"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}"
                                data-image="{{ $product->image }}"
                                data-description="{{ $product->description }}">
                                <i class="fas fa-edit"></i> Sửa
                            </button>
                            
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center; color: #64748b; padding: 30px;">
                            Kho hàng trống. Vui lòng thêm sản phẩm mới!
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </section>

    <footer>
        <div class="footer-links">
            <a href="#">Về chúng tôi</a>
            <a href="#">Hỗ trợ khách hàng</a>
            <a href="#">Chính sách bảo mật</a>
        </div>
        <div class="footer-socials">
            <i class="fab fa-instagram"></i>
            <i class="fab fa-facebook-f"></i>
        </div>
    </footer>

    <div class="modal-overlay" id="editModal">
        <div class="modal-content">
            <i class="fas fa-times modal-close" onclick="closeEditModal()"></i>
            <h2 style="color: #1e3a8a; margin-bottom: 20px; font-size: 24px;">Sửa Sản Phẩm</h2>
            
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Giá (VNĐ)</label>
                        <input type="number" name="price" id="edit_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tồn kho</label>
                        <input type="number" name="stock" id="edit_stock" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Hình ảnh (URL)</label>
                    <input type="text" name="image" id="edit_image" class="form-control" oninput="previewEditImage()">
                    <img id="edit_preview" src="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-top: 10px; display: none;">
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn-success" style="width: 100%; font-size: 16px; padding: 12px;">Lưu Thay Đổi</button>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="addModal">
        <div class="modal-content">
            <i class="fas fa-times modal-close" onclick="closeAddModal()"></i>
            <h2 style="color: #1e3a8a; margin-bottom: 20px; font-size: 24px;">Thêm Sản Phẩm Mới</h2>
            
            <form method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Giá (VNĐ)</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tồn kho</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Hình ảnh (URL)</label>
                    <input type="text" name="image" id="add_image" class="form-control" oninput="previewAddImage()">
                    <img id="add_preview" src="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-top: 10px; display: none;">
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn-success" style="width: 100%; font-size: 16px; padding: 12px;">Thêm Sản Phẩm</button>
            </form>
        </div>
    </div>

    <script>
        // --- XỬ LÝ POP-UP SỬA ---
        function openEditModal(button) {
            let id = button.getAttribute('data-id');
            document.getElementById('edit_name').value = button.getAttribute('data-name');
            document.getElementById('edit_price').value = button.getAttribute('data-price');
            document.getElementById('edit_stock').value = button.getAttribute('data-stock');
            document.getElementById('edit_image').value = button.getAttribute('data-image');
            document.getElementById('edit_description').value = button.getAttribute('data-description');

            previewEditImage();

            let baseUrl = "{{ route('admin.products.update', ':id') }}";
            document.getElementById('editForm').action = baseUrl.replace(':id', id);

            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }

        function previewEditImage() {
            let imgUrl = document.getElementById('edit_image').value;
            let preview = document.getElementById('edit_preview');
            preview.src = imgUrl;
            preview.style.display = imgUrl ? 'block' : 'none';
        }

        // --- XỬ LÝ POP-UP THÊM ---
        function openAddModal() {
            document.getElementById('addModal').classList.add('active');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.remove('active');
        }

        function previewAddImage() {
            let imgUrl = document.getElementById('add_image').value;
            let preview = document.getElementById('add_preview');
            preview.src = imgUrl;
            preview.style.display = imgUrl ? 'block' : 'none';
        }

        // --- TẮT POP-UP KHI BẤM RA NGOÀI ---
        window.onclick = function(event) {
            let editModal = document.getElementById('editModal');
            let addModal = document.getElementById('addModal');
            if (event.target == editModal) {
                closeEditModal();
            }
            if (event.target == addModal) {
                closeAddModal();
            }
        }
    </script>
</body>

</html>