'''

'''


from Decision.Builder.BuilderAbstract import BuilderAbstract
from Decision import Engine


class Xml(BuilderAbstract):
	
	
	_xml = None


	def _get_xml(self):
		
		return self._xml

	
	def _set_xml(self, xml):
		
		self._xml = xml
		return self
	
	
	xml = property(fget=_get_xml, fset=_set_xml)


	def build(self):

		MyEngine = Engine()
		
		return MyEngine
	