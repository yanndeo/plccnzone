
import '../css/app.css';
import React,{useState, useEffect} from 'react';
import ReactDOM from 'react-dom';

//Component
import Category from './components/category/index';
import Product from './components/product/index';
import Search from "./components/search/index";
import Pub from "./components/pub/index";
import Newsletter from "./components/newsletter/index";

//API
import { _getDefaultDataApi, slugify } from './actions/index';



const App = () => {

    //STATE
    const [products, setProducts] = useState([]);
    const [searchValue, setSearchValue] = useState('');
    const [filterCatValue, setFilterCatValue] = useState('')
    const [categories, setCategories] = useState([]);



    
    //COMPONENTDIDMOUNT
    useEffect(()=>{
        _getDefaultDataApi()
            .then((res)=>{
                setProducts(res.modifiedDataProducts);
                setCategories(res.categories);
            });
    },[]);






    /**
     * @param {*} value 
     * Enregistre le mot clé (search_bar) comme
     * valeur dans le state
     */
    const mySearchFunction = (value) => {
        setSearchValue(value);
    } 


    /**
     * Définir l'id de la catégorie dans le state
     * pour ensuite filtrer les produits du tableau
     * en fonction
     */
    const myFilterFunction = (e,catID) => {
        e.preventDefault();
        setFilterCatValue(catID);
    }


    return (
        
        <div className="row">
            <div className="col-lg-4">
                <div className="blog_right_sidebar">
                    <Search 
                        mySearchFunctionCallback={(value) => mySearchFunction(value) } />
                    <Pub/>
                    <Category 
                        data={categories} 
                        myFilterFunctionCallback = {(e,catID) => myFilterFunction(e,catID)} />
                    <Newsletter/>
                </div>
            </div>

            <div className="col-lg-8" >
                <Product
                    data={products} 
                    searchValue= {searchValue} 
                    filterCatValue = {filterCatValue} />
            </div>

            
        </div>
    )
}

ReactDOM.render( <App/> , document.getElementById('root'));