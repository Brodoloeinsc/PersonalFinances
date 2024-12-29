const names = document.getElementsByClassName('nameD');
const values = document.getElementsByClassName('valueD');

const namesArray = Array.from(names).map(name => name.textContent);
const valuesArray = Array.from(values).map(value => parseFloat(value.textContent));

const ctx = document.getElementById('despesasChart').getContext('2d');
const despesasChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: namesArray,
        datasets: [{
            label: 'Despesas',
            data: valuesArray,
            backgroundColor: 'rgba(192, 75, 75, 0.6)',
            borderColor: 'rgba(192, 75, 75, 1)',
            borderWidth: 1
        }]
    },
})