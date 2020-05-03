import axios from 'axios';



export const _getDefaultDataApi = async() =>{

    try {

      let {data:{categories, products, fabricants}} = await axios.get(`/api/default-data`); ; 
     
      const modifiedDataProducts = products.map((product) => ({
           id: product.id,
           libelle: product.libelle,
           reference: product.reference,
           fabricant: product.fabricant.name
       }));

       return {categories, modifiedDataProducts, fabricants} ;

    } catch (error) {
        console.log(error);
    }
}




export const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}