<nav class="bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="#" class="text-white font-bold text-xl">Daily Expenses</a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:block">
                <ul class="ml-4 flex items-center space-x-4">
                    <li><a href="main.php" class="text-gray-300 hover:text-white">หน้าหลัก</a></li>
                    <li><a href="new-transaction.php" class="text-gray-300 hover:text-white">บันทึกรายการใหม่</a></li>
                    <li class="relative">
                        <button class="text-gray-300 hover:text-white focus:outline-none" id="servicesDropdownBtn">
                            จัดการบัญชี
                            <svg class="ml-1 h-4 w-4 inline-block fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul class="absolute z-10 hidden bg-gray-700 mt-2 py-2 w-32 rounded-md" id="servicesDropdown">
                            <li><a href="create-new-account.php" class="block px-4 py-2 text-white hover:bg-gray-600">สร้างบัญชีใหม่</a></li>
                            <li><a href="accounts.php" class="block px-4 py-2 text-white hover:bg-gray-600">จัดการบัญชี</a></li>
                            <li><a href="transfer.php" class="block px-4 py-2 text-white hover:bg-gray-600">โอนเงินไปบัญชีอื่น</a></li>
                            <li><a href="transfer-history.php" class="block px-4 py-2 text-white hover:bg-gray-600">ประวัติการโอน</a></li>
                            <li><a href="transactions.php" class="block px-4 py-2 text-white hover:bg-gray-600">รายการทั้งหมด</a></li>
                        </ul>
                    </li>
                    <li class="relative">
                        <button class="text-gray-300 hover:text-white focus:outline-none" id="servicesDropdownBtn2">
                            ดูตามกิจกรรม
                            <svg class="ml-1 h-4 w-4 inline-block fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul class="absolute z-10 hidden bg-gray-700 mt-2 py-2 w-32 rounded-md" id="servicesDropdown2">
                            <li><a href="incomes-transaction.php" class="block px-4 py-2 text-white hover:bg-gray-600">รายรับ</a></li>
                            <li><a href="expenses-transaction.php" class="block px-4 py-2 text-white hover:bg-gray-600">รายจ่าย</a></li>
                        </ul>
                    </li>
                    <li class="relative">
                        <button class="text-gray-300 hover:text-white focus:outline-none" id="servicesDropdownBtn3">
                            รายจ่ายรายเดือน
                            <svg class="ml-1 h-4 w-4 inline-block fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul class="absolute z-10 hidden bg-gray-700 mt-2 py-2 w-32 rounded-md" id="servicesDropdown3">
                            <li><a href="monthly-payment.php" class="block px-4 py-2 text-white hover:bg-gray-600">เพิ่มรายจ่าย</a></li>
                            <li><a href="monthly-payment-summary.php" class="block px-4 py-2 text-white hover:bg-gray-600">รายจ่ายรายเดือน</a></li>
                            <li><a href="" class="block px-4 py-2 text-white hover:bg-gray-600">ปรับรายจ่าย</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php" class="text-gray-300 hover:text-white">Logout</a></li>
                </ul>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="text-gray-300 hover:text-white focus:outline-none focus:text-white">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>