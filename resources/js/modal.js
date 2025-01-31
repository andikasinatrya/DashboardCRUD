document.addEventListener("DOMContentLoaded", () => {
    const sidebarWrapper = document.getElementById("sidebar-wrapper");

    // Modal Create
    const createModal = document.getElementById("createModal");
    const openCreateModalButton = document.getElementById("openCreateModal");
    const closeCreateModalButton = document.getElementById("closeCreateModal");

    if (createModal && openCreateModalButton && closeCreateModalButton) {
        openCreateModalButton.addEventListener("click", (e) => {
            e.preventDefault();
            createModal.classList.remove("hidden");
            sidebarWrapper.style.display = "none";
        });

        closeCreateModalButton.addEventListener("click", () => {
            createModal.classList.add("hidden");
            sidebarWrapper.style.display = "block";
        });

        createModal.addEventListener("click", (e) => {
            if (e.target === createModal) {
                createModal.classList.add("hidden");
                sidebarWrapper.style.display = "block";
            }
        });
    }

    // Modal Edit
    const editModal = document.getElementById("editModal");
    const openEditModalButtons = document.querySelectorAll(".openEditModal");
    const closeEditModalButton = document.getElementById("closeEditModal");
    const editForm = document.getElementById("editForm");
    const editNameInput = document.getElementById("editName");

    if (
        editModal &&
        openEditModalButtons &&
        closeEditModalButton &&
        editForm &&
        editNameInput
    ) {
        openEditModalButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                e.preventDefault();
                const hobbyId = button.getAttribute("data-id");
                const hobbyName = button.getAttribute("data-name");

                console.log(
                    `Opening edit modal for hobbyId: ${hobbyId}, hobbyName: ${hobbyName}`
                );

                editForm.action = `/javascript/${hobbyId}`;
                editNameInput.value = hobbyName;

                editModal.classList.remove("hidden");
                sidebarWrapper.style.display = "none";
            });
        });

        closeEditModalButton.addEventListener("click", () => {
            editModal.classList.add("hidden");
            sidebarWrapper.style.display = "block";
        });

        editModal.addEventListener("click", (e) => {
            if (e.target === editModal) {
                editModal.classList.add("hidden");
                sidebarWrapper.style.display = "block";
            }
        });
    }

    const deleteButtons = document.querySelectorAll(".openDeleteModal");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            const hobbyId = button.getAttribute("data-id");

            console.log(`Deleting hobby with ID: ${hobbyId}`);

            const deleteForm = document.getElementById(`deleteForm${hobbyId}`);
            deleteForm.submit();
        });
    });

    // Menambahkan input Phone
    document.getElementById("add-phone").addEventListener("click", function () {
        const newInput = document.createElement("input");
        newInput.type = "text";
        newInput.name = "telephone_number[]";
        newInput.classList.add(
            "mt-1",
            "block",
            "w-full",
            "rounded-md",
            "border-gray-300",
            "shadow-sm",
            "focus:ring-blue-500",
            "focus:border-blue-500"
        );
        newInput.placeholder = "Masukkan Nomor Telepon";
        newInput.required = true;

        document.getElementById("phone-area").appendChild(newInput);
    });

    document
        .getElementById("remove-phone")
        .addEventListener("click", function () {
            const inputs = document.querySelectorAll(
                'input[name="telephone_number[]"]'
            );

            if (inputs.length > 1) {
                inputs[inputs.length - 1].remove();
            }
        });

    document.getElementById("add-phone").addEventListener("click", function () {
        const phoneArea = document.getElementById("phone-area");
        if (!phoneArea.querySelector('input[name="telephone_number[]"]')) {
            const newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "telephone_number[]";
            newInput.className =
                "mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500";
            newInput.required = true;
            phoneArea.appendChild(newInput);
        }
    });

    document
        .getElementById("remove-phone")
        .addEventListener("click", function () {
            const phoneArea = document.getElementById("phone-area");
            const lastInput = phoneArea.querySelector(
                'input[name="telephone_number[]"]'
            );
            if (lastInput) {
                phoneArea.removeChild(lastInput);
            }
        });

    // Add Slider
});
