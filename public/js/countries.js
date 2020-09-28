let countries;
const countriesList = document.getElementById("countries");
const currenciesList = document.getElementById("currencies");

fetch("https://restcountries.eu/rest/v2/all")
    .then(res => res.json())
    .then(data => initialize(data))
    .catch(err => console.log("Error", err));

function initialize(countriesData) {
    console.log(countriesData);
    countries = countriesData;
    let options = `<option value="">Please pick a country </option>"`;
    let options2 = `<option value="">Please pick a Currency </option>"`;

    countries.forEach(
        country =>
            (options += `<option value="${country.name}">${country.name} </option>`)
    );
    countries.forEach(
        country =>
            (options2 += `<option value="${country.currencies[0].code}">${country.currencies[0].code} </option>`)
    );

    countriesList.innerHTML = options;
    currenciesList.innerHTML = options2;
}
