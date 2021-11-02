import { memo, useContext } from 'react';

import { SelectControl } from '@wordpress/components';

import { apiContext } from '../..';
import { useSetApi } from '../../hooks/useSetApi';
import { psiLocals } from '../../lib/locale';
import { apiType } from '../../types/apiType';

export const Select = memo( ( props: { itemKey: string } ) => {
	const { apiData, setApiData } = useContext( apiContext );
	const { itemKey } = props;

	const changeLocale = ( value: string ) => {
		const newItem: apiType = JSON.parse( JSON.stringify( { ...apiData } ) );

		newItem.abt_locale = String( value );
		setApiData( newItem );
	};

	useSetApi( itemKey, apiData.abt_locale! );

	return (
		<SelectControl
			value={ apiData.abt_locale }
			options={ Object.values( psiLocals ).map( ( locale: any ) => ( {
				label: locale.name,
				value: locale.id,
			} ) ) }
			onChange={ ( value ) => changeLocale( value ) }
		/>
	);
} );
