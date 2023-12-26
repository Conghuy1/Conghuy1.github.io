
/*Chuyen danh sach*/

const movieContainer = document.querySelector('.movie-container');
const movies = document.querySelectorAll('.movie');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

const itemsPerPage = 5;
let currentPage = 1;

function showMovies(page) {
    movies.forEach((movie, index) => {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        if (index >= startIndex && index < endIndex) {
            movie.classList.remove('hidden');
        } else {
            movie.classList.add('hidden');
        }
    });
}

showMovies(currentPage);

prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        showMovies(currentPage);
    }
});

nextButton.addEventListener('click', () => {
    if (currentPage < Math.ceil(movies.length / itemsPerPage)) {
        currentPage++;
        showMovies(currentPage);
    }
});


function showMovies(page) {
    movies.forEach((movie, index) => {
      const startIndex = (page - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
  
      if (index >= startIndex && index < endIndex) {
        movie.classList.remove('hidden');
        movie.style.pointerEvents = 'auto'; // Hiển thị và cho phép sự kiện chuột
      } else {
        movie.classList.add('hidden');
        movie.style.pointerEvents = 'none'; // Ẩn và vô hiệu hóa sự kiện chuột
      }
    });
}
  

//Nhan thong tin tu nguoi dung khi bam vao hinh anh

// Xử lý sự kiện khi click vào hình ảnh phim
