function handleSubmit() {
    const time = document.getElementById('time').value;
    const cour = document.getElementById('cour').value;

    localStorage.setItem("TIME", time);
    localStorage.setItem("COUR", cour);
    return;
}