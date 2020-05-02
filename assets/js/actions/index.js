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