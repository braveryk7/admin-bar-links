import { apiType, locationItemsType, locationsType } from '../types/apiType';

export const shortNameList = [
	'psi',
	'lh',
	'gsc',
	'gc',
	'gi',
	'bi',
	'twitter',
	'facebook',
	'hatena',
] as const;

export const getApiInitValue = () => {
	const locationItems: locationItemsType = {
		name: '',
		shortname: 'psi',
		status: false,
		url: '',
		adminurl: '',
		order: 0,
	};

	const locations: locationsType = {
		psi: { ...locationItems },
		lh: { ...locationItems },
		gsc: { ...locationItems },
		gc: { ...locationItems },
		gi: { ...locationItems },
		bi: { ...locationItems },
		twitter: { ...locationItems },
		facebook: { ...locationItems },
		hatena: { ...locationItems },
	};

	const abtOptions: apiType = {
		items: { ...locations },
		locale: '',
		sc: 0,
		version: 0,
	};

	return abtOptions;
};
