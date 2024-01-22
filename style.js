document.addEventListener('DOMContentLoaded', function () {
    const mainSection = document.getElementById('main-section');

    mainSection.addEventListener('mouseover', function() {
        this.style.backgroundColor = '#eee';
    });

    mainSection.addEventListener('mouseout', function() {
        this.style.backgroundColor = '#fff';
    });
});
