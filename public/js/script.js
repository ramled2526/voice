document.addEventListener('DOMContentLoaded', function () {
    const roles = document.querySelectorAll('.role');
    const continueButton = document.querySelector('.btn-continue');

    roles.forEach(role => {
        role.addEventListener('click', function () {
            roles.forEach(r => r.classList.remove('active'));
            this.classList.add('active');
            const selectedRole = this.getAttribute('data-role');
            continueButton.href = `/${selectedRole}`;
            continueButton.classList.remove('disabled');
        });
    });
});


