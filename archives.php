<?php
ob_start();
include("partials/head.php");
include("partials/nav.php");
include("metalabsdb.php");
?>

<?php
if (isset($_GET['restore_msg'])) {
    ?>

<div class="w-full text-white bg-yellow-400">
    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
        <div class="flex">
            <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                <path
                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                </path>
            </svg>

            <p class="mx-3">
                <?= $_GET['restore_msg'] ?>
            </p>
        </div>

        <button id="closeButton"
            class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</div>
<script>
document.getElementById("closeButton").addEventListener("click", function() {
    var parentDiv = this.closest('.w-full');
    parentDiv.style.display = "none";
});
</script>

<?php
}
?>


<section class="container mx-auto mt-[40px]">
    <div class="flex justify-center items-center gap-x-2 ml-5 mb-5 mr-5">
        <input type="text" id="searchInput"
            class="drop-shadow-sm border md:pl-6 md:pr-32 p-2 rounded-md focus:outline-none" placeholder="Search...">
        <button id="searchButton"
            class="shadow flex items-center px-5 py-2 text-sm text-white capitalize transition-colors duration-200 bg-blue-500 border rounded-md gap-x-2 hover:bg-blue-400">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="1.5"
                class="w-5 h-5">
                <path fill=" none" d="M0 0h24v24H0z"></path>
                <path
                    d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z">
                </path>
            </svg>
            <span>Search</span>
        </button>
    </div>
    <div class="border p-6 mx-5 md:p-8 shadow-md rounded-[24px]">

        <div class="flex items-center justify-between gap-x-3">
            <div>
                <h2 class="text-lg font-medium text-gray-800">Archives</h2>
                <p class="text-gray-500 w-96 lg:w-auto hidden md:flex">This section stores the deleted student records
                    from the enrollment section
                </p>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 px-6">
                    <div class="overflow-hidden border border-gray-200  md:rounded-lg ">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        ID</th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Name</th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Course</th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Birthdate</th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Contact Number</th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Restore</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200  ">
                                <?php

                                $page = isset($_GET['page']) ? $_GET['page'] : 1; // Default page
                                $rowsPerPage = 6; //Max rows per page
                                
                                $query = "SELECT * FROM `student_archive` LIMIT " . ($page - 1) * $rowsPerPage . ", $rowsPerPage";
                                $result = mysqli_query($connection, $query);

                                if (!$result) {
                                    die("query failed" . mysqli_error());
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                        <?= $row['id']; ?>
                                    </td>
                                    <td class="pl-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                        <?= $row['first_name'] . " " . $row['last_name']; ?>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                        <?= $row['course']; ?>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                        <?= $row['birthdate']; ?>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                        <?= "+63" . substr($row['contact_number'], 1); ?>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-x-6 ">

                                            <a href="#" onclick="confirmRestore(<?= $row['id'] ?>)"
                                                class="flex flex-row gap-x-3 text-pink-400 transition-colors duration-200 hover:text-yellow-500 focus:outline-none">

                                                <script>
                                                function confirmRestore(id) {
                                                    if (confirm("Are you sure you want to restore this record?")) {
                                                        window.location.href = 'archives.php?id=' + id;
                                                    }
                                                }
                                                </script>

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1"
                                                    stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        fill="rgba(244,144,182)"
                                                        d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z" />
                                                </svg>

                                                <span>
                                                    Restore Student
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                $totalRowsQuery = "SELECT COUNT(*) as total FROM `student_archive`";
                                $totalResult = mysqli_query($connection, $totalRowsQuery);
                                $totalRows = mysqli_fetch_assoc($totalResult)['total'];
                                $totalPages = ceil($totalRows / $rowsPerPage);
                                ?>

                            </tbody>
                        </table>

                        <?php
                        if (mysqli_num_rows($result) <= 0) {
                            ?>
                        <div class="flex items-center p-20 text-center bg-gray-50">
                            <div class="flex flex-col w-full max-w-sm px-4 mx-auto">
                                <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg> -->
                                    <lord-icon src="https://cdn.lordicon.com/vuiggmtc.json" trigger="in"
                                        colors="primary:#3080e8" style="width:32px;height:25px">
                                    </lord-icon>
                                </div>
                                <h1 class="mt-3 text-lg text-gray-800">No students archived</h1>
                                <p class="mt-2 text-gray-500">Your archives table does not have any records at the
                                    moment...</p>

                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>





        <!-- PAGINATION DIV -->
        <div class="flex items-center justify-between mt-6">
            <a href="?page=<?= max($page - 1, 1) ?>"
                class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>previous</span>
            </a>

            <div class="items-center hidden lg:flex gap-x-3">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class=" px-2 py-1 text-sm <?= $i == $page ? 'text-blue-500' : 'text-gray-500' ?> rounded-md
                    <?= $i == $page ? 'bg-blue-100/60' : 'hover:bg-gray-100' ?>">
                    <?= $i ?>
                </a>
                <?php endfor; ?>
            </div>

            <a href="?page=<?= min($page + 1, $totalPages) ?>"
                class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100">
                <span>Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
        <!-- END OF PAGINATION DIV -->


    </div>
</section>

<!-- search bar script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#searchInput').keyup(function() {
        var searchText = $(this).val().toLowerCase();
        $('tbody tr').hide();
        $('tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(searchText) !== -1) {
                $(this).show();
            }
        });
    });
});
</script>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `student_archive` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("query failed");
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $birthdate = $row['birthdate'];
            $address = $row['address'];
            $contactNumber = $row['contact_number'];
            $course = $row['course'];
            $gender = $row['gender'];
            $city = $row['city'];
            $region = $row['region'];
            $postalCode = $row['postal_code'];
            $department = $row['department'];
            $yearLevel = $row['year_level'];
        }

        if (isset($_GET['id'])) {
            $query = "INSERT INTO `student_enrollment` (`id`, `first_name`, `last_name`, `birthdate`, `address`, `contact_number`, `course`, `gender`, `city`, `region`, `postal_code`, `department`, `year_level`) values
            ('$id', '$firstName', '$lastName', '$birthdate', '$address', '$contactNumber', '$course', '$gender', '$city', '$region', '$postalCode', '$department', '$yearLevel')";
            $result = mysqli_query($connection, $query);
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "DELETE FROM `student_archive` WHERE `id` = '$id'";
            $result = mysqli_query($connection, $query);

            header('Location: archives.php?restore_msg=You have restored a record!');
            exit();
        }

        ob_end_flush();
    }
}

// if (isset($_GET['restore_msg'])) {
//     echo "<h6>" . $_GET['restore_msg'] . "</h6>";
// }

include("partials/footer.php");
?>