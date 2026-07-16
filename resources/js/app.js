import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// delete button
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({
                title: 'Delete Book?',
                text: 'This book is permanently deleted from your listings.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});

// listing page
        setTimeout(function() {
            let flashMessage = document.getElementById('flash-message');

            if (flashMessage) {
                let alert = new bootstrap.Alert(flashMessage);
                alert.close();
            }
        }, 10000);

        // browse page
      
    document.querySelectorAll('.request-type-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const bookId = this.dataset.bookId;
            const offeredBox = document.getElementById('offeredBox' + bookId);
            const offeredDetails = document.getElementById('offeredDetails' + bookId);

            if (this.value === 'exchange') {
                offeredBox.classList.remove('d-none');
                offeredDetails.setAttribute('required', 'required');
            } else {
                offeredBox.classList.add('d-none');
                offeredDetails.removeAttribute('required');
                offeredDetails.value = '';
            }
        });
    });


//    add form

    const listingTypeRadios = document.querySelectorAll('input[name="listing_type"]');
    const exchangePreferenceBox = document.getElementById('exchangePreferenceBox');

    function toggleExchangePreference() {
        const selectedType = document.querySelector('input[name="listing_type"]:checked').value;

        if (selectedType === 'exchange' || selectedType === 'both') {
            exchangePreferenceBox.style.display = 'block';
        } else {
            exchangePreferenceBox.style.display = 'none';
        }
    }

    listingTypeRadios.forEach(function(radio) {
        radio.addEventListener('change', toggleExchangePreference);
    });

    toggleExchangePreference();

// request page ajax
document.addEventListener('DOMContentLoaded', function () {
    const savedTab = localStorage.getItem('activeRequestTab');

    if (savedTab) {
        const tabButton = document.querySelector(`[data-bs-target="${savedTab}"]`);

        if (tabButton && window.bootstrap) {
            new bootstrap.Tab(tabButton).show();
        }
    }

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function (tab) {
        tab.addEventListener('shown.bs.tab', function (event) {
            localStorage.setItem('activeRequestTab', event.target.getAttribute('data-bs-target'));
        });
    });
});

