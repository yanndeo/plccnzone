import React from 'react'

const Index = () => {

	
    return (
        <aside className="single-sidebar-widget newsletter_widget">
			<h4 className="widget_title">Newsletter</h4>
			<p>Rester au courant des produits produits à tout instant.</p>
			<div className="form-group d-flex flex-row">
			<div className="input-group">
				<div className="input-group-prepend">
					<div className="input-group-text">
						<i className="fa fa-envelope" aria-hidden="true"></i>
					</div>
				</div>
				<input
					type="text" 
					className="form-control" 
					id="inlineFormInputGroup" 
					placeholder="Entrer email" />
			</div>
				<a href="#" className="bbtns">S'inscrire</a>
			</div>
			<div className="br"></div>
		</aside>
    )
}

export default Index