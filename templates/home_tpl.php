<?php function mainview(array $departments){?>
    <h1 id = "filter_by">Filter by:</h1>
    <div id = "filters">
        <h3>Department:</h3>
        <select id = "filter_department">
        <option value="all">All Departments</option>
            <?php foreach($departments as $department): ?>
                <option value = "<?= $department['id'] ?>"><?= $department['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <h3>Date:</h3>
        <select id="filter_sort">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
        </select>
        <h3>State:</h3>
        <select id="filter_state">
            <option value="all">All States</option>
            <option value="open">Open</option>
            <option value="assigned">Assigned</option>
            <option value="solved">Solved</option>
            <option value="closed">Closed</option>
        </select>
        <a id = "create_ticket" href="../pages/create.php"><button>Create Ticket</button></a>
            </div>
        <div id = "ticket_list"></div>
        <script src="../script/filters.js"></script>
    </main>    
    </body>

<?php } ?>