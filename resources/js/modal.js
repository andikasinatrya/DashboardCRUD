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

    // Add Slider
});
