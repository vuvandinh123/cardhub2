
function toggleBookmark(carId, slug, title, price, year, fuel, mileage, bodytype, image) {
    let bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
    const carIndex = bookmarks.findIndex(car => car.id === carId);

    if (carIndex > -1) {
        // Remove from bookmarks
        bookmarks.splice(carIndex, 1);
        localStorage.setItem('savedCars', JSON.stringify(bookmarks));
        updateBookmarkUI(carId, false);
        showToast('Đã xóa khỏi danh sách yêu thích', 'info');
    } else {
        // Add to bookmarks
        bookmarks.push({
            id: carId,
            slug: slug, 
            title: title,
            price: price,
            year: year,
            fuel: fuel,
            mileage: mileage,
            bodytype: bodytype,
            image: image,
            savedAt: new Date().toISOString()
        });
        localStorage.setItem('savedCars', JSON.stringify(bookmarks));
        updateBookmarkUI(carId, true);
        showToast('Đã lưu xe vào danh sách yêu thích', 'success');
    }

    updateBookmarkCount();
}

function updateBookmarkUI(carId, isBookmarked) {
    $(`.bookmark-btn-${carId}`).each(function () {
        if (isBookmarked) {
            $(this).addClass('active').attr('title', 'Bỏ lưu xe');
        } else {
            $(this).removeClass('active').attr('title', 'Lưu xe');
        }
    });
}

function updateBookmarkCount() {
    const bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
    $('.bookmark-count').text(bookmarks.length);
}

function initializeBookmarks() {
    const bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
    $.each(bookmarks, function (index, car) {
        updateBookmarkUI(car.id, true);
    });
    updateBookmarkCount();
}

function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className =
                `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 animate-toast-in ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            toast.innerHTML = `
                <div class="flex items-center gap-2">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('animate-toast-in');
                toast.classList.add('animate-toast-out');
                setTimeout(() => toast.remove(), 250);
            }, 3000);
        }

$(function () {
    // floating-contacts logic moved to partials/floating-contacts.blade.php
});



// Initialize bookmarks on page load
$(document).ready(function () {
    initializeBookmarks();

    const swiper = new Swiper('.swiper-categories', {
        slidesPerView: 6,
        slidesPerGroup: 1,
        spaceBetween: 20,
        speed: 400,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1280: {
                slidesPerView: 6,
                spaceBetween: 14,
            },
        },
    });

    new Swiper('.swiper-slider', {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 20,
        speed: 400,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});