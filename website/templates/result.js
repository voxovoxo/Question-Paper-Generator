 window.addEventListener('load', () => {
    const params = (new URL(document.location)).searchParams;
    const time = params.get('time');
    const cour = params.get('cour');
   document.getElementById('result-time').innerHTML = time;
    document.getElementById('result-courses').innerHTML = cour;

})