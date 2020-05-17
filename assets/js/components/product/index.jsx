import React, { Component } from 'react'
import {BootstrapTable, TableHeaderColumn} from 'react-bootstrap-table';
import Skeleton from 'react-loading-skeleton';
import {capitalize } from '../../actions/index';




class Index extends Component {

    constructor(props){
      super(props);

      this.rowEvent = {
        onClick: (e, row, rowIndex) => {
           alert(row)
        }
      };

      //CUMTOMIZE LA SELECTION DE LA ROW
      this.selectRow = {
        mode: 'radio',
        bgColor: 'orange',
        hideSelectColumn: true,
        clickToSelect: true,
        onSelect: (row, isSelect, rowIndex, e) => {
          console.log(row.id);
        }
      };


      /* OPTIONS */
       this.options = {
        defaultSortName: 'libelle', // default sort column name
        defaultSortOrder: 'asc', // default sort order
        page: 1,
        sizePerPage: 21,
        onRowClick: function (row, rowIndex, columnIndex, event) {}
      };

    }


     



    render () {

      const {data, searchValue, filterCatValue} = this.props;
      console.log('filterCatValue', filterCatValue)

      /* Personalization d'une row */
      const colFormatter = (cell, row) =>{
            return (
                <span>
                    <a href={`/article/${row.slug}-${row.id}`} style={{textDecoration:'none', color:'grey'}}> {cell} </a>
                </span>
            ) 
      }




        let renderData ;
        if(data && data.length > 0){

            var products = data;
            
            if(filterCatValue){
               products = products.filter(item => (item.categories.includes(filterCatValue)));

            }

            if (searchValue) {
               products = products.filter((pb) => pb?.libelle.indexOf(capitalize(searchValue)) != -1)
            }

            renderData = (
              <BootstrapTable 
                    data={products} striped hover
                    options ={this.options}
                    pagination={ true }
                    search={ false }
                    multiColumnSearch={ true }
                    selectRow={this.selectRow }
                    rowEvents={this.rowEvent}>
                  <TableHeaderColumn isKey dataField='reference' dataFormat={colFormatter}>REFERENCE </TableHeaderColumn>
                  <TableHeaderColumn dataField='libelle' dataFormat={colFormatter}> EQUIPEMENT </TableHeaderColumn>
                  <TableHeaderColumn dataField='fabricant' dataFormat={colFormatter}> FABRICANT </TableHeaderColumn>
              </BootstrapTable>
            )

        }else{
          renderData = <Skeleton count ={14} height={40} />
        }




        return (

          <div className="blog_left_sidebar">
            {renderData}
          </div>
        );
    }
}

export default Index