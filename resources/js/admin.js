// book listing delete button
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-book-form").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Delete Book Listing?",
                html: "This action cannot be undone.<br><small>The listing will be permanently removed.</small>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete Listing",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#dc3545",
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

// suspend button
document.querySelectorAll('.suspend-student-form').forEach(form => {

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        Swal.fire({
            title: 'Suspend Student?',
            text: 'The student will lose access to BookNest until reactivated.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Suspend',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});

// activate button
document.querySelectorAll('.activate-student-form').forEach(form => {

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        Swal.fire({
            title: 'Activate Student?',
            text: 'The student will regain access to BookNest.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Activate',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#198754',
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});
// pyq delete button
document.querySelectorAll('.delete-pyq-form').forEach(form => {

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        Swal.fire({
            title: 'Delete PYQ Paper?',
            text: 'This paper and its file will be permanently removed.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});
