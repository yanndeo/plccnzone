import axios from 'axios';



export const _getDefaultDataApi = async() =>{

    try {

      let {data:{categories, products, fabricants}} = await axios.get(`/api/default-data`); ; 

      const modifiedDataProducts = products.map((product) => ({
           id: product.id,
           libelle: capitalize(product.libelle),
           reference: product.reference,
           fabricant: product.fabricant.name,
           categories: product.categories.map(cat => cat.id) //donne moi uniquement que les id
       }));

       return { categories, modifiedDataProducts, fabricants } ;


    } catch (error) {
        console.log('_getDefaultDataApi', error);
    }
}



//Capitalize Text
export const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}



export const slugify = (text) => {
    return text
            .toString() // Cast to string
            .toLowerCase() // Convert the string to lowercase letters
            .normalize('NFD') // The normalize() method returns the Unicode Normalization Form of a given string.
            .trim() // Remove whitespace from both sides of a string
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-'); // Replace multiple - with single -
}