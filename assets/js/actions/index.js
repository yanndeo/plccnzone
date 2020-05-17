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




export const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}