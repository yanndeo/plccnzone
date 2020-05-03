import React,{useState} from 'react'

const Index = ({mySearchFunctionCallback}) => {

	const [searchValue, setSearchValue] = useState('');

	const handleChangeSearch = (e)=>{
		setSearchValue(e.target.value)
	}

	const handleKeyUpSearch = (e) => {
		//if(searchValue && searchValue !== ''){
			return mySearchFunctionCallback(searchValue)
		//}
		// if(e.keyCode == 13){
		// 	return alert('okk')
		// }
	}


	return (
        <aside className="single_sidebar_widget search_widget">
			<div className="input-group">
				<input 
					type="text" 
					id="search__bar"
					className="form-control" 
					placeholder="Rechercher un équipement"
					onKeyUp={handleKeyUpSearch}
					onChange={handleChangeSearch}
					value={searchValue}
					name="search"
				/>
				<span className="input-group-btn">
					<button className="btn btn-default" type="button">
						<i className="lnr lnr-magnifier"></i>
					</button>
				</span>
			</div>
			<div className="br"></div>
		</aside>
    )
}

export default Index