$(() => {

    // Select elements by their data attribute
    const $entryInfoElements = $('[data-liste]');

    // Map over each element and extract the data value
    const $entryInfoObjects =
        $.map($entryInfoElements, item => $(item).data('entryInfo'));

    const $liste = $entryInfoObjects['listeChroniques'];
    // You'll now have array of objects to work with
    console.log($liste); // eg: [{id: 1, subheading: "...", title: "..."}]
});