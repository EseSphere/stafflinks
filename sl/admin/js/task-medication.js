
const scrollable = document.getElementById('draggable-table');
let isDown = false;
let startX, startY, scrollLeft, scrollTop;

scrollable.addEventListener('mousedown', (e) => {
    isDown = true;
    scrollable.classList.add('dragging');
    startX = e.pageX - scrollable.offsetLeft;
    startY = e.pageY - scrollable.offsetTop;
    scrollLeft = scrollable.scrollLeft;
    scrollTop = scrollable.scrollTop;
});

scrollable.addEventListener('mouseleave', () => {
    isDown = false;
    scrollable.classList.remove('dragging');
});

scrollable.addEventListener('mouseup', () => {
    isDown = false;
    scrollable.classList.remove('dragging');
});

scrollable.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - scrollable.offsetLeft;
    const y = e.pageY - scrollable.offsetTop;
    const walkX = x - startX;
    const walkY = y - startY;
    scrollable.scrollLeft = scrollLeft - walkX;
    scrollable.scrollTop = scrollTop - walkY;
});
