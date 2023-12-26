// Xử lý hiển thị thông tin phim dựa trên tham số truyền vào từ URL
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const movieTitle = urlParams.get('movie');
    
    const movieTitleElement = document.querySelector('.movie-title');
    const movieImageElement = document.querySelector('.movie-image');
    
    movieTitleElement.textContent = decodeURIComponent(movieTitle);
    movieImageElement.src = `/images/${movieTitle}.jpg`;
    movieImageElement.alt = movieTitle;
});


//An nut truoc khi bam dat ve
function toggleListButton() {
    var listButton = document.querySelector('.list');
  
    // Toggle the visibility of the list button
    if (listButton.style.display === 'none') {
      listButton.style.display = 'block';
    } else {
      listButton.style.display = 'none';
    }
  }

  //Hien thi danh sach rap chieu
  function toggleListButton() {
    var listButton = document.querySelector('.list');
    var cinemaList = document.getElementById('cinemaList');
  
    // Toggle the visibility of the list button and hide cinema list
    if (listButton.style.display === 'none') {
      listButton.style.display = 'block';
      cinemaList.style.display = 'none';
    } else {
      listButton.style.display = 'none';
    }
  }
  
  function showList() {
    var cinemaList = document.getElementById('cinemaList');
  
    // Show cinema list
    cinemaList.style.display = 'block';
  }
  
  function hideList() {
    var cinemaList = document.getElementById('cinemaList');
  
    // Hide cinema list
    cinemaList.style.display = 'none';
  }
  
  