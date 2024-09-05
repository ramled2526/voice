document.addEventListener('DOMContentLoaded', function () {
    const roles = document.querySelectorAll('.role');
    const continueButton = document.querySelector('.btn-continue');

    roles.forEach(role => {
        role.addEventListener('click', function () {
            roles.forEach(r => r.classList.remove('active'));
            this.classList.add('active');
            const selectedRole = this.getAttribute('data-role');
            
            // Update the href of the Continue button
            continueButton.href = `/${selectedRole}`;
            
            // Remove disabled styles from Continue button
            continueButton.classList.remove('opacity-50', 'cursor-not-allowed');
            continueButton.classList.add('cursor-pointer');
        });
    });
});


function selectRole(element) {
    document.querySelectorAll('.role').forEach(role => role.classList.remove('icon-selected'));
    element.classList.add('icon-selected');
    document.querySelector('.btn-continue').classList.remove('disabled');
}
