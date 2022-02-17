// @ts-ignore
import api from '@wordpress/api'; // eslint-disable-line
import { useContext, useEffect, useRef } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

import { apiContext } from '..';
import { useSetApiType } from '../types/apiType';

export const useSetApi: useSetApiType = ( itemKey, value ) => {
	const {
		apiData,
		setNoticeStatus,
		setNoticeValue,
		setNoticeMessage,
		snackbarTimer,
	} = useContext( apiContext );

	const isFirstRender = useRef( true );

	useEffect( () => {
		if ( isFirstRender.current ) {
			isFirstRender.current = false;
		} else {
			api.loadPromise.then( () => {
				const model = new api.models.Settings( {
					[ itemKey ]: value,
				} );
				const save = model.save();

				setNoticeStatus( false );
				clearTimeout( snackbarTimer );

				save.success( () => {
					setNoticeStatus( true );
					setNoticeValue( 'abt_success' );
					setNoticeMessage( __( 'Success.', 'admin-bar-tools' ) );
				} );
				save.error( () => {
					setNoticeStatus( true );
					setNoticeValue( 'abt_error' );
					setNoticeMessage( __( 'Error.', 'admin-bar-tools' ) );
				} );
			} );
		}
	}, [ apiData ] );
};
