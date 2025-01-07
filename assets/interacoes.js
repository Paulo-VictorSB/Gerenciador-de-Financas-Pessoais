document.querySelector('#saldo').addEventListener('click', () => {
    const content = document.querySelector('#saldoMostrar');
    const chevronIcon = document.querySelector('#chevron');

    // se o saldoMostrar tiver com o display none ou vazio faça as seguintes alterações
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.opacity = 1;
        content.style.display = 'flex';
        setTimeout(() => {
            content.style.height = '70px';
        }, 10);
        chevronIcon.classList.remove('fa-chevron-down');
        chevronIcon.classList.add('fa-chevron-up');
    } else {
        content.style.opacity = 0;
        content.style.height = '0';
        setTimeout(() => {
            content.style.display = 'none';
        }, 300);
        chevronIcon.classList.remove('fa-chevron-up');
        chevronIcon.classList.add('fa-chevron-down');
    }
});