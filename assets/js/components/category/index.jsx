import React from 'react'
import Skeleton from 'react-loading-skeleton';



const Index = ({data, myFilterFunctionCallback } ) => {


	/**
	 * Affiche la liste des
	 * categories ou le skeleton
	 */
	let renderData;

	if(data && data.length > 0){
		renderData = data.map((category, i) => {
		   let {id, name, countProducts } = category
				return (
					<li key={i}>
						<a href='#'
						   id={id} 
						   className="d-flex justify-content-between"
						   onClick={(e) => myFilterFunctionCallback(e,id)}>
							<p>{name}</p>
							<p>{countProducts}</p>  
						{/*//est ce important en front */}						
						</a>
					</li>
				) }) ;

	}else{
		renderData = <Skeleton count={6} /> ;
	}

    return (
		<aside className="single_sidebar_widget post_category_widget">
			<h4 className="widget_title">Categories</h4>
				<ul className="list cat-list">
					{renderData}
				</ul>
			<div className="br"></div>
		</aside>
		
    )
}

export default Index